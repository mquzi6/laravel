@extends('layouts.app')

@section('title', 'Оформление заказа')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
            <li class="breadcrumb-item"><a href="{{ route('orders.cart') }}">Корзина</a></li>
            <li class="breadcrumb-item active">Оформление</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="fw-medium mb-5" style="font-size: 2.5rem;">Оформление заказа</h1>
            
            {{-- Состав заказа --}}
            <div class="card bg-light-custom p-5 mb-4">
                <h5 class="fw-semibold mb-4">Ваш заказ</h5>
                
                @foreach($cartItems as $item)
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                        <div>
                            <span class="fw-medium">{{ $item->product->name }}</span>
                            <small class="text-muted d-block">{{ $item->quantity }} шт. × {{ number_format($item->price, 0) }} ₽</small>
                        </div>
                        <span class="fw-bold">{{ number_format($item->price * $item->quantity, 0) }} ₽</span>
                    </div>
                @endforeach
                
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Подытог</span>
                    <span class="fw-medium">{{ number_format($cartItems->sum(fn($item) => $item->price * $item->quantity), 0) }} ₽</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Доставка</span>
                    <span class="text-success fw-medium">Бесплатно</span>
                </div>
                <div class="d-flex justify-content-between mt-3 pt-3 border-top">
                    <span class="fw-semibold fs-5">Итого к оплате</span>
                    <span class="fw-bold fs-3" style="color: var(--accent);">
                        {{ number_format($cartItems->sum(fn($item) => $item->price * $item->quantity), 0) }} ₽
                    </span>
                </div>
            </div>
            
            {{-- Способ оплаты --}}
            <div class="card bg-light-custom p-5">
                <h5 class="fw-semibold mb-4">Способ оплаты</h5>
                
                <div class="alert bg-white rounded-4 mb-4">
                    <i class="bi bi-info-circle me-2" style="color: var(--accent);"></i>
                    Это демо-версия магазина. Оплата не производится.
                </div>
                
                <div class="mb-4">
                    <div class="form-check p-3 border rounded-4 mb-2">
                        <input class="form-check-input" type="radio" name="payment" id="card" checked>
                        <label class="form-check-label fw-medium" for="card">
                            <i class="bi bi-credit-card me-2"></i> Банковская карта
                        </label>
                    </div>
                    <div class="form-check p-3 border rounded-4">
                        <input class="form-check-input" type="radio" name="payment" id="cash">
                        <label class="form-check-label fw-medium" for="cash">
                            <i class="bi bi-cash me-2"></i> Наличными при получении
                        </label>
                    </div>
                </div>
                
                <form action="{{ route('orders.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary w-100 py-4">
                        Подтвердить заказ
                    </button>
                </form>
                
                <a href="{{ route('orders.cart') }}" class="btn btn-link text-muted text-decoration-none mt-3">
                    <i class="bi bi-arrow-left me-2"></i> Вернуться в корзину
                </a>
            </div>
        </div>
    </div>
</div>
@endsection