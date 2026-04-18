@extends('layouts.app')

@section('title', 'История заказов')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
            <li class="breadcrumb-item active">История заказов</li>
        </ol>
    </nav>

    <h1 class="fw-medium mb-5" style="font-size: 2.5rem;">История заказов</h1>
    
    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif
    
    @if($orders->count() > 0)
        @foreach($orders as $order)
            <div class="card bg-light-custom mb-4 p-4">
                <div class="row align-items-center mb-3">
                    <div class="col-md-3">
                        <span class="text-muted small d-block">Заказ №{{ $order->id }}</span>
                        <span class="fw-semibold">{{ $order->created_at->format('d.m.Y') }}</span>
                    </div>
                    <div class="col-md-3">
                        <span class="text-muted small d-block">Сумма</span>
                        <span class="fw-bold" style="color: var(--accent);">{{ number_format($order->total, 0) }} ₽</span>
                    </div>
                    <div class="col-md-3">
                        <span class="text-muted small d-block">Статус</span>
                        <span class="badge bg-success text-white py-2 px-3 rounded-pill">Оплачено</span>
                    </div>
                    <div class="col-md-3 text-md-end">
                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#order{{ $order->id }}">
                            Детали <i class="bi bi-chevron-down ms-1"></i>
                        </button>
                    </div>
                </div>
                
                <div class="collapse mt-3" id="order{{ $order->id }}">
                    <hr class="my-3">
                    @foreach($order->items as $item)
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <span class="fw-medium">{{ $item->product->name }}</span>
                                <small class="text-muted d-block">{{ $item->quantity }} шт. × {{ number_format($item->price, 0) }} ₽</small>
                            </div>
                            <span class="fw-medium">{{ number_format($item->price * $item->quantity, 0) }} ₽</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @else
        <div class="text-center py-5">
            <i class="bi bi-clock-history fs-1 text-muted"></i>
            <h3 class="fw-light mt-4">У вас пока нет заказов</h3>
            <p class="text-muted mb-4">Перейдите в каталог, чтобы выбрать мебель</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary px-5 py-3">
                Перейти в каталог
            </a>
        </div>
    @endif
</div>
@endsection