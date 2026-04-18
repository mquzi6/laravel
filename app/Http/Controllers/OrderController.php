<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function cart()
    {
        $user = Auth::user();
        
        $cartItems = CartItem::where('user_id', $user->id)
            ->with('product')
            ->get();

        $total = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });

        return view('orders.cart', compact('cartItems', 'total'));
    }

    public function addToCart(Product $product)
    {
        $user = Auth::user();

        $cartItem = CartItem::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price
            ]);
        }

        return redirect()->route('orders.cart')->with('success', 'Товар добавлен в корзину!');
    }

    public function remove($id)
    {
        $cartItem = CartItem::findOrFail($id);
        
        if ($cartItem->user_id != Auth::id()) {
            abort(403);
        }
        
        $cartItem->delete();

        return redirect()->route('orders.cart')->with('success', 'Товар удален из корзины.');
    }

    public function payment()
    {
        $user = Auth::user();
        
        $cartItems = CartItem::where('user_id', $user->id)
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('orders.cart')->with('error', 'Корзина пуста');
        }

        return view('orders.payment', compact('cartItems'));
    }

    public function checkout(Request $request)
    {
        return DB::transaction(function() use ($request) {
            $user = Auth::user();
            
            $cartItems = CartItem::where('user_id', $user->id)
                ->with('product')
                ->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('orders.cart')->with('error', 'Ваша корзина пуста.');
            }

            $total = $cartItems->sum(function($item) {
                return $item->price * $item->quantity;
            });

            $order = Order::create([
                'user_id' => $user->id,
                'total' => $total,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price
                ]);
                
                $item->delete();
            }

            return redirect()->route('orders.history')
                ->with('success', 'Заказ успешно оформлен! Спасибо за покупку.');
        });
    }

    public function history()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.history', compact('orders'));
    }
}