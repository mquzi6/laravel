@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
            <li class="breadcrumb-item active">Корзина</li>
        </ol>
    </nav>

    <h1 class="fw-bold mb-4 text-white" style="font-size: 2.5rem;">КОРЗИНА</h1>
    
    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mb-4">{{ session('error') }}</div>
    @endif
    
    @if($cartItems->count() > 0)
        <div class="row g-4">
            <div class="col-lg-8">
                @foreach($cartItems as $item)
                    <div class="card bg-light-custom mb-3 p-3">
                        <div class="row align-items-center">
                            <div class="rounded-3 overflow-hidden" style="height: 80px; width: 80px;">
                                <img src="{{ $item->product->image ? asset('public/img/'.$item->product->image) : asset('public/img/png.png') }}" 
                                    class="w-100 h-100" 
                                    alt="{{ $item->product->name }}"
                                    style="object-fit: cover;">
                            </div>
                            <div class="col-md-4">
                                <h6 class="fw-bold text-white mb-1">{{ $item->product->name }}</h6>
                                <small class="text-muted">{{ $item->product->category ?? 'Dota 2' }}</small>
                            </div>
                            <div class="col-md-2">
                                <span class="text-white">{{ $item->quantity }} шт.</span>
                            </div>
                            <div class="col-md-2">
                                <span class="fw-bold" style="color: var(--accent);">{{ number_format($item->price * $item->quantity, 0) }} ₽</span>
                            </div>
                            <div class="col-md-2 text-end">
                                <form action="{{ route('orders.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="col-lg-4">
                <div class="card bg-light-custom p-4 sticky-top" style="top: 20px;">
                    <h5 class="fw-bold text-white mb-4">СУММА ЗАКАЗА</h5>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Товары ({{ $cartItems->sum('quantity') }} шт.)</span>
                        <span class="text-white">{{ number_format($total, 0) }} ₽</span>
                    </div>
                    
                    <hr style="border-color: var(--border);">
                    
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold text-white fs-5">ИТОГО</span>
                        <span class="fw-bold fs-4" style="color: var(--accent);">{{ number_format($total, 0) }} ₽</span>
                    </div>
                    
                    <a href="{{ route('orders.payment') }}" class="btn btn-primary w-100 py-3 mb-3">
                        ОФОРМИТЬ ЗАКАЗ
                    </a>
                    
                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary w-100 py-2">
                        <i class="bi bi-arrow-left me-2"></i> Продолжить покупки
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="bi bi-cart3" style="font-size: 4rem; color: var(--text-light);"></i>
            </div>
            <h3 class="fw-bold text-white mb-3">КОРЗИНА ПУСТА</h3>
            <p class="text-muted mb-4">Добавьте скины, чтобы оформить заказ</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary px-5 py-3">
                ПЕРЕЙТИ В МАРКЕТ
            </a>
        </div>
    @endif
</div>
@endsection