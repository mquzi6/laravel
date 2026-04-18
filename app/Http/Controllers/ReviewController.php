<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $user = Auth::user();

        // Проверка, купил ли пользователь товар
        $purchased = $user->orders()
            ->whereHas('items', function($q) use ($product) {
                $q->where('product_id', $product->id);
            })
            ->exists();

        if (!$purchased) {
            return redirect()->back()->with('error', 'Вы можете оставить отзыв только на купленные товары.');
        }

        // Проверка на повторный отзыв
        $exists = Review::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Вы уже оставили отзыв на этот товар.');
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Review::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Отзыв успешно добавлен.');
    }
}