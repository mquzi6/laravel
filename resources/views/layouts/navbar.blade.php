<nav class="navbar navbar-expand-lg py-3" style="background: var(--primary); border-bottom: 1px solid var(--border);">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}" style="font-size: 1.8rem; letter-spacing: -0.02em;">
            <span style="color: white;">SKIN</span><span style="color: var(--accent);">MARKET</span>
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item px-3">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold' : '' }}" 
                       href="{{ route('home') }}"
                       style="color: var(--text);">
                        <i class="bi bi-house me-1"></i> ГЛАВНАЯ
                    </a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link {{ request()->routeIs('products.index') ? 'active fw-bold' : '' }}" 
                       href="{{ route('products.index') }}"
                       style="color: var(--text);">
                        <i class="bi bi-grid me-1"></i> МАРКЕТ
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav align-items-center">
                @guest
                    <li class="nav-item me-2">
                        <a class="nav-link" href="{{ route('login') }}" style="color: var(--text);">
                            <i class="bi bi-box-arrow-in-right me-1"></i> ВХОД
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{ route('register') }}">
                            <i class="bi bi-person-plus me-1"></i> РЕГИСТРАЦИЯ
                        </a>
                    </li>
                @else
                    <li class="nav-item me-3">
                        <a class="nav-link position-relative p-2" href="{{ route('orders.cart') }}" style="color: var(--text);">
                            <i class="bi bi-cart3" style="font-size: 1.3rem;"></i>
                            @php
                                $cartCount = App\Models\CartItem::where('user_id', Auth::id())->sum('quantity');
                            @endphp
                            @if($cartCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge" 
                                      style="background-color: var(--accent); font-size: 0.7rem;">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" 
                           data-bs-toggle="dropdown" style="color: var(--text);">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-2" 
                                 style="width: 36px; height: 36px; background: var(--accent);">
                                <span class="text-white fw-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            </div>
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" style="background: var(--card-bg); border: 1px solid var(--border); border-radius: 8px; padding: 0.5rem;">
                            <li>
                                <a class="dropdown-item py-3 px-4" href="{{ route('orders.history') }}" style="color: var(--text);">
                                    <i class="bi bi-clock-history me-3"></i> История покупок
                                </a>
                            </li>
                            @if(Auth::user()->isAdmin() || Auth::user()->isManager())
                                <li><hr class="dropdown-divider" style="border-color: var(--border);"></li>
                                <li>
                                    <a class="dropdown-item py-3 px-4" href="{{ route('admin.dashboard') }}" style="color: var(--text);">
                                        <i class="bi bi-shield-shaded me-3"></i> АДМИН-ПАНЕЛЬ
                                    </a>
                                </li>
                            @endif
                            <li><hr class="dropdown-divider" style="border-color: var(--border);"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-3 px-4 text-danger">
                                        <i class="bi bi-box-arrow-right me-3"></i> Выйти
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<style>
.nav-link {
    font-weight: 600;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
    position: relative;
    transition: all 0.3s;
}
.nav-link:hover {
    color: var(--accent) !important;
}
.nav-link.active {
    color: var(--accent) !important;
}
.nav-link.active::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 50%;
    transform: translateX(-50%);
    width: 30px;
    height: 2px;
    background: var(--accent);
    box-shadow: 0 0 10px var(--accent);
}
.dropdown-item:hover {
    background: var(--primary-light);
    color: var(--accent) !important;
    border-radius: 4px;
}
</style>