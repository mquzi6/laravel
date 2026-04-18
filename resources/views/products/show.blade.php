@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container py-5">
    {{-- Хлебные крошки --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Маркет</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row g-5">
        {{-- Изображение --}}
        <div style="height: 500px; border-radius: 16px; overflow: hidden;">
            <img src="{{ $product->image ? asset('public/img/'.$product->image) : asset('public/img/png.png') }}" 
                class="w-100 h-100" 
                alt="{{ $product->name }}"
                style="object-fit: cover;">
        </div>
        
        {{-- Информация --}}
        <div class="col-lg-6">
            <div class="mb-4">
                <span class="badge-custom mb-3">
                    <i class="bi bi-{{ $product->category == 'Dota 2' ? 'shield' : 'bullseye' }} me-1"></i>
                    {{ $product->category ?? 'Dota 2' }}
                </span>
                <h1 class="fw-bold mb-3 text-white" style="font-size: 2.5rem;">{{ $product->name }}</h1>
                
                <div class="d-flex align-items-center mb-4">
                    <div class="star-rating me-3">
                        @for($i=1; $i<=5; $i++)
                            <i class="bi bi-star{{ $i <= $product->rating ? '-fill' : '' }}" style="color: #ffc107;"></i>
                        @endfor
                    </div>
                    <span class="text-muted small">{{ $product->reviews->count() }} отзывов</span>
                </div>
                
                <h2 class="fw-bold mb-4" style="color: var(--accent); font-size: 2.2rem;">
                    {{ number_format($product->price, 0) }} ₽
                </h2>
            </div>
            
            {{-- Характеристики --}}
            <div class="mb-4 p-4 rounded-3" style="background: var(--card-bg); border: 1px solid var(--border);">
                <h5 class="fw-bold text-white mb-3">Характеристики</h5>
                <div class="row">
                    <div class="col-6 mb-3">
                        <span class="text-muted small d-block">Игра</span>
                        <span class="text-white">{{ $product->category ?? '—' }}</span>
                    </div>
                    <div class="col-6 mb-3">
                        <span class="text-muted small d-block">Редкость</span>
                        <span class="text-white">{{ $product->material ?? '—' }}</span>
                    </div>
                    <div class="col-6 mb-3">
                        <span class="text-muted small d-block">Качество</span>
                        <span class="text-white">{{ $product->color ?? '—' }}</span>
                    </div>
                    <div class="col-6 mb-3">
                        <span class="text-muted small d-block">Доп. инфо</span>
                        <span class="text-white">{{ $product->dimensions ?? '—' }}</span>
                    </div>
                </div>
            </div>
            
            {{-- Описание --}}
            @if($product->description)
            <div class="mb-4">
                <h5 class="fw-bold text-white mb-3">Описание</h5>
                <p class="text-muted" style="line-height: 1.8;">{{ $product->description }}</p>
            </div>
            @endif
            
            {{-- Кнопка покупки --}}
            @auth
                <form action="{{ route('orders.add', $product) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg w-100 py-3">
                        <i class="bi bi-cart-plus me-2"></i> ДОБАВИТЬ В КОРЗИНУ
                    </button>
                </form>
            @else
                <div class="alert bg-light-custom border-0 rounded-3 p-4 text-center">
                    <i class="bi bi-info-circle me-2" style="color: var(--accent);"></i>
                    <a href="{{ route('login') }}" class="fw-bold text-white">Войдите</a> или 
                    <a href="{{ route('register') }}" class="fw-bold text-white">зарегистрируйтесь</a>, чтобы купить
                </div>
            @endauth
        </div>
    </div>
    
    {{-- Отзывы --}}
    <div class="row mt-5">
        <div class="col-12">
            <div class="card bg-light-custom p-4 p-lg-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold text-white mb-0">Отзывы покупателей</h3>
                    <span class="badge-custom">{{ $product->reviews->count() }} отзывов</span>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success mb-4">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger mb-4">{{ session('error') }}</div>
                @endif
                
                @auth
                    @php
                        $canReview = auth()->user()->orders()->whereHas('items', function($q) use ($product) {
                            $q->where('product_id', $product->id);
                        })->exists();
                        $hasReviewed = $product->reviews->where('user_id', auth()->id())->isNotEmpty();
                    @endphp
                    
                    @if($canReview && !$hasReviewed)
                        <form action="{{ route('reviews.store', $product) }}" method="POST" class="mb-4 p-4 bg-white rounded-3">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">Ваш отзыв</label>
                                <textarea name="content" class="form-control" rows="3" 
                                          placeholder="Расскажите о ваших впечатлениях...">{{ old('content') }}</textarea>
                                @error('content')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Оставить отзыв</button>
                        </form>
                    @elseif(!$canReview && auth()->check())
                        <div class="alert bg-white mb-4 rounded-3">
                            <i class="bi bi-lock me-2"></i> Оставить отзыв можно только после покупки
                        </div>
                    @endif
                @endauth
                
                @if($product->reviews->count() > 0)
                    <div class="reviews-list">
                        @foreach($product->reviews as $review)
                            <div class="review-item p-4 mb-3 bg-white rounded-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                                             style="width: 40px; height: 40px; background: var(--primary-light);">
                                            <span class="text-white fw-bold">{{ strtoupper(substr($review->user->name, 0, 1)) }}</span>
                                        </div>
                                        <strong>{{ $review->user->name }}</strong>
                                    </div>
                                    <small class="text-muted">{{ $review->created_at->format('d.m.Y') }}</small>
                                </div>
                                <p class="mb-0 text-muted">{{ $review->content }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4 bg-white rounded-3">
                        <i class="bi bi-chat fs-1 text-muted"></i>
                        <p class="text-muted mt-3 mb-0">Пока нет отзывов. Будьте первым!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection