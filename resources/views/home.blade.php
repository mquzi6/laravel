@extends('layouts.app')

@section('title', 'SKINMARKET — Торговая площадка скинов Dota 2 и CS2')

@section('content')
    {{-- Hero секция --}}
    <section class="position-relative" style="min-height: 70vh; background: linear-gradient(135deg, #0a0e17 0%, #151e2b 100%);">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="opacity: 0.1; background: radial-gradient(circle at 30% 50%, var(--accent) 0%, transparent 50%);"></div>
        <div class="position-absolute top-0 end-0 w-100 h-100" style="opacity: 0.1; background: radial-gradient(circle at 70% 50%, var(--accent-secondary) 0%, transparent 50%);"></div>
        
        <div class="container position-relative" style="z-index: 1;">
            <div class="row min-vh-70 align-items-center" style="min-height: 70vh;">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="mb-4">
                        <span class="badge-custom" style="background: rgba(255,70,85,0.2); color: var(--accent); border: 1px solid var(--accent);">
                            <i class="bi bi-shield-check me-2"></i>БЕЗОПАСНЫЕ СДЕЛКИ 24/7
                        </span>
                    </div>
                    <h1 class="display-3 fw-bold mb-4" style="color: white; line-height: 1.2;">
                        ПОКУПАЙ И ПРОДАВАЙ <br>
                        <span style="color: var(--accent);">
                            <i class="bi bi-trophy"></i> СКИНЫ
                        </span> 
                        МГНОВЕННО
                    </h1>
                    <p class="lead mb-5" style="color: var(--text); font-size: 1.2rem;">
                        Dota 2 • CS2 • Тысячи предметов • Лучшие цены • Мгновенный вывод
                    </p>
                    
                    {{-- Поиск --}}
                    <div class="row justify-content-center mb-5">
                        <div class="col-md-8">
                            <form action="{{ route('products.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control form-control-lg" 
                                           placeholder="Поиск скинов... Например: Dragon Lore, Arcana, Karambit..."
                                           style="background: var(--primary-light); border: 1px solid var(--border); color: white;">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="bi bi-search me-2"></i> ПОИСК
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    {{-- Статистика --}}
                    <div class="row g-4 mt-5">
                        <div class="col-md-4">
                            <div class="p-4 rounded-3" style="background: var(--card-bg); border: 1px solid var(--border);">
                                <i class="bi bi-people fs-1 mb-3" style="color: var(--accent-secondary);"></i>
                                <h3 class="fw-bold text-white mb-2">1.2M+</h3>
                                <p class="mb-0" style="color: var(--text-light);">ПОЛЬЗОВАТЕЛЕЙ</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 rounded-3" style="background: var(--card-bg); border: 1px solid var(--border);">
                                <i class="bi bi-cart-check fs-1 mb-3" style="color: var(--success);"></i>
                                <h3 class="fw-bold text-white mb-2">50K+</h3>
                                <p class="mb-0" style="color: var(--text-light);">СДЕЛОК В ДЕНЬ</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 rounded-3" style="background: var(--card-bg); border: 1px solid var(--border);">
                                <i class="bi bi-box-seam fs-1 mb-3" style="color: var(--warning);"></i>
                                <h3 class="fw-bold text-white mb-2">500K+</h3>
                                <p class="mb-0" style="color: var(--text-light);">ПРЕДМЕТОВ</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Игры --}}
    <section class="py-5">
        <div class="container py-4">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card p-5 text-center" style="background: linear-gradient(135deg, #1a1e2e 0%, #252b3d 100%);">
                        <i class="bi bi-shield-shaded fs-1 mb-3" style="color: #ff4655;"></i>
                        <h3 class="fw-bold text-white mb-3">DOTA 2</h3>
                        <p class="mb-4" style="color: var(--text);">Arcanas, Immortals, Collector's Cache</p>
                        <a href="{{ route('products.index', ['category' => 'Dota 2']) }}" class="btn btn-primary">
                            СМОТРЕТЬ <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card p-5 text-center" style="background: linear-gradient(135deg, #1a1e2e 0%, #252b3d 100%);">
                        <i class="bi bi-bullseye fs-1 mb-3" style="color: #5c8aff;"></i>
                        <h3 class="fw-bold text-white mb-3">CS2</h3>
                        <p class="mb-4" style="color: var(--text);">Knives, Gloves, AK-47, AWP, M4A4</p>
                        <a href="{{ route('products.index', ['category' => 'CS2']) }}" class="btn btn-primary">
                            СМОТРЕТЬ <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Популярные товары --}}
    <section class="py-5">
        <div class="container">
            <div class="section-subtitle">
                <i class="bi bi-fire" style="color: var(--warning);"></i> ГОРЯЧИЕ ПРЕДЛОЖЕНИЯ
            </div>
            <h2 class="section-title">ПОПУЛЯРНЫЕ СКИНЫ</h2>
            
            <div class="row g-4">
    @forelse($popularProducts as $product)
    <div class="col-md-3">
        <div class="card h-100">
            <div class="position-relative" style="height: 220px;">
                <span class="position-absolute top-0 start-0 m-3 badge" style="background: var(--accent); z-index: 2;">
                    <i class="bi bi-star-fill me-1"></i> ТОП
                </span>
                <img src="{{ $product->image ? asset('public/img/'.$product->image) : asset('public/img/png.png') }}" 
                     class="w-100 h-100" 
                     alt="{{ $product->name }}"
                     style="object-fit: cover;">
            </div>
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-2">
                    <span class="badge-custom">{{ $product->category ?? 'Dota 2' }}</span>
                </div>
                <h5 class="card-title fw-bold mb-2 text-white">{{ $product->name }}</h5>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="price-tag">{{ number_format($product->price, 0) }} ₽</span>
                    <a href="{{ route('products.show', $product) }}" class="btn btn-outline-primary btn-sm">
                        КУПИТЬ
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <p class="text-muted">Товары скоро появятся</p>
    </div>
    @endforelse
</div>
            
            <div class="text-center mt-5">
                <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg px-5">
                    <i class="bi bi-grid me-2"></i> ВЕСЬ МАРКЕТ
                </a>
            </div>
        </div>
    </section>

    {{-- Новинки --}}
    <section class="py-5 bg-light-custom">
        <div class="container">
            <div class="section-subtitle">ТОЛЬКО ПОСТУПИЛИ</div>
            <h2 class="section-title">НОВИНКИ</h2>
            
            <div class="row g-4">
    @forelse($newProducts as $product)
    <div class="col-md-3">
        <div class="card h-100">
            <div class="position-relative" style="height: 220px;">
                <span class="position-absolute top-0 start-0 m-3 badge" style="background: var(--success); z-index: 2;">NEW</span>
                <img src="{{ $product->image ? asset('public/img/'.$product->image) : asset('public/img/png.png') }}" 
                     class="w-100 h-100" 
                     alt="{{ $product->name }}"
                     style="object-fit: cover;">
            </div>
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-2">
                    <span class="badge-custom">{{ $product->category ?? 'Dota 2' }}</span>
                </div>
                <h5 class="card-title fw-bold mb-2 text-white">{{ $product->name }}</h5>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="price-tag">{{ number_format($product->price, 0) }} ₽</span>
                    <a href="{{ route('products.show', $product) }}" class="btn btn-outline-primary btn-sm">
                        КУПИТЬ
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <p class="text-muted">Новинки скоро появятся</p>
    </div>
    @endforelse
</div>
        </div>
    </section>

    {{-- Как это работает --}}
    <section class="py-5">
        <div class="container py-4">
            <div class="section-subtitle">ПРОСТО И БЫСТРО</div>
            <h2 class="section-title">КАК ЭТО РАБОТАЕТ</h2>
            
            <div class="row g-4 mt-4">
                <div class="col-md-3 text-center">
                    <div class="p-4">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-4" 
                             style="width: 80px; height: 80px; background: var(--accent);">
                            <i class="bi bi-person-plus fs-2 text-white"></i>
                        </div>
                        <h5 class="fw-bold text-white mb-3">1. РЕГИСТРАЦИЯ</h5>
                        <p class="small" style="color: var(--text-light);">Создай аккаунт за 30 секунд</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="p-4">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-4" 
                             style="width: 80px; height: 80px; background: var(--accent-secondary);">
                            <i class="bi bi-wallet2 fs-2 text-white"></i>
                        </div>
                        <h5 class="fw-bold text-white mb-3">2. ПОПОЛНЕНИЕ</h5>
                        <p class="small" style="color: var(--text-light);">Пополни баланс любым способом</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="p-4">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-4" 
                             style="width: 80px; height: 80px; background: var(--success);">
                            <i class="bi bi-cart-check fs-2 text-white"></i>
                        </div>
                        <h5 class="fw-bold text-white mb-3">3. ПОКУПКА</h5>
                        <p class="small" style="color: var(--text-light);">Выбирай скины и покупай мгновенно</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="p-4">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-4" 
                             style="width: 80px; height: 80px; background: var(--warning);">
                            <i class="bi bi-gift fs-2 text-white"></i>
                        </div>
                        <h5 class="fw-bold text-white mb-3">4. ПОЛУЧЕНИЕ</h5>
                        <p class="small" style="color: var(--text-light);">Забирай предметы в игре или инвентаре</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Баннер --}}
    <section class="py-5" style="background: linear-gradient(135deg, var(--accent) 0%, #ff2d40 100%);">
        <div class="container py-4">
            <div class="row align-items-center text-center text-lg-start">
                <div class="col-lg-9">
                    <h2 class="fw-bold text-white mb-3" style="font-size: 2.2rem;">
                        <i class="bi bi-gift me-3"></i> НАЧНИ ПОКУПАТЬ ПРЯМО СЕЙЧАС!
                    </h2>
                    <p class="mb-0 text-white" style="opacity: 0.95; font-size: 1.1rem;">
                        Тысячи скинов Dota 2 и CS2 ждут тебя. Лучшие цены на рынке!
                    </p>
                </div>
                <div class="col-lg-3 text-lg-end mt-4 mt-lg-0">
                    <a href="{{ route('products.index') }}" class="btn btn-light btn-lg px-5 fw-bold" style="color: var(--accent);">
                        В МАРКЕТ <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

<style>
.min-vh-70 {
    min-height: 70vh;
}
</style>