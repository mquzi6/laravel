@extends('layouts.app')

@section('title', 'Маркет скинов Dota 2 и CS2')

@section('content')
<div class="container py-5">
    {{-- Хлебные крошки --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
            <li class="breadcrumb-item active">Маркет</li>
        </ol>
    </nav>

    <div class="row mb-4">
        <div class="col-12">
            <div class="section-subtitle text-start">
                <i class="bi bi-grid-3x3-gap-fill me-2"></i> ВЫБИРАЙ И ПОКУПАЙ
            </div>
            <h1 class="fw-bold mb-3 text-white" style="font-size: 2.5rem;">МАРКЕТ СКИНОВ</h1>
            <p class="text-muted">Dota 2 • CS2 • Тысячи предметов по лучшим ценам</p>
        </div>
    </div>

    {{-- Фильтры по играм --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('products.index') }}" class="btn {{ !request('category') ? 'btn-primary' : 'btn-outline-primary' }}">
                    <i class="bi bi-grid me-2"></i> ВСЕ ИГРЫ
                </a>
                <a href="{{ route('products.index', ['category' => 'Dota 2']) }}" class="btn {{ request('category') == 'Dota 2' ? 'btn-primary' : 'btn-outline-primary' }}">
                    <i class="bi bi-shield-shaded me-2"></i> DOTA 2
                </a>
                <a href="{{ route('products.index', ['category' => 'CS2']) }}" class="btn {{ request('category') == 'CS2' ? 'btn-primary' : 'btn-outline-primary' }}">
                    <i class="bi bi-bullseye me-2"></i> CS2
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Фильтры --}}
        <div class="col-lg-3">
            <div class="card bg-light-custom p-4 sticky-top" style="top: 20px;">
                <h5 class="fw-bold text-white mb-4">
                    <i class="bi bi-funnel me-2"></i> ФИЛЬТРЫ
                </h5>
                
                <form method="GET" action="{{ route('products.index') }}">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    
                    <div class="mb-4">
                        <label class="form-label">ПОИСК</label>
                        <div class="position-relative">
                            <i class="bi bi-search position-absolute" style="left: 15px; top: 12px; color: var(--text-light);"></i>
                            <input type="text" name="search" class="form-control ps-5" 
                                   placeholder="Название скина..." 
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">ЦЕНА (₽)</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="number" name="min_price" class="form-control" placeholder="От" 
                                       value="{{ request('min_price') }}">
                            </div>
                            <div class="col-6">
                                <input type="number" name="max_price" class="form-control" placeholder="До" 
                                       value="{{ request('max_price') }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">СОРТИРОВКА</label>
                        <select name="sort" class="form-select">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>🆕 Новые</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>💰 Дешевле</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>💎 Дороже</option>
                            <option value="rating_desc" {{ request('sort') == 'rating_desc' ? 'selected' : '' }}>⭐ По рейтингу</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 py-3 mb-2">
                        <i class="bi bi-search me-2"></i> ПРИМЕНИТЬ
                    </button>
                    
                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary w-100 py-3">
                        <i class="bi bi-x-circle me-2"></i> СБРОСИТЬ
                    </a>
                </form>
            </div>
        </div>
        
        {{-- Сетка товаров --}}
        <div class="col-lg-9">
            @if($products->count() > 0)
                <div class="row g-4">
                    @foreach($products as $product)
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="position-relative" style="height: 200px;">
                                <img src="{{ $product->image ? asset('public/img/'.$product->image) : asset('public/img/png.png') }}" 
                                    class="w-100 h-100" 
                                    alt="{{ $product->name }}"
                                    style="object-fit: cover;">
                            </div>
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="badge-custom">
                                        <i class="bi bi-{{ $product->category == 'Dota 2' ? 'shield' : 'bullseye' }} me-1"></i>
                                        {{ $product->category ?? 'Dota 2' }}
                                    </span>
                                </div>
                                <h5 class="card-title fw-bold mb-2 text-white">{{ $product->name }}</h5>
                                <p class="small mb-2" style="color: var(--text-light);">
                                    {{ $product->material ?? '' }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="price-tag">{{ number_format($product->price, 0) }} ₽</span>
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-outline-primary btn-sm">
                                        КУПИТЬ
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                @if ($products->hasPages())
                <div class="mt-5">
                    <nav>
                        <ul class="pagination justify-content-center">
                            @if ($products->onFirstPage())
                                <li class="page-item disabled"><span class="page-link"><i class="bi bi-chevron-left"></i></span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}"><i class="bi bi-chevron-left"></i></a></li>
                            @endif

                            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            @if ($products->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}"><i class="bi bi-chevron-right"></i></a></li>
                            @else
                                <li class="page-item disabled"><span class="page-link"><i class="bi bi-chevron-right"></i></span></li>
                            @endif
                        </ul>
                    </nav>
                </div>
                @endif
            @else
                <div class="text-center py-5">
                    <i class="bi bi-search fs-1" style="color: var(--text-light);"></i>
                    <h3 class="fw-bold text-white mt-4">СКИНЫ НЕ НАЙДЕНЫ</h3>
                    <p class="text-muted">Попробуйте изменить параметры поиска</p>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary mt-3 px-5">
                        СБРОСИТЬ ФИЛЬТРЫ
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection