@extends('layouts.app')

@section('title', 'Вход')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="text-center mb-4">
                <h2 class="fw-medium">С возвращением</h2>
                <p class="text-muted">Войдите в свой аккаунт</p>
            </div>
            
            <div class="card bg-light-custom p-5">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <div class="position-relative">
                            <i class="bi bi-envelope position-absolute" style="left: 15px; top: 12px; color: var(--text-light);"></i>
                            <input id="email" type="email" 
                                   class="form-control ps-5 @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" 
                                   required autofocus
                                   placeholder="your@email.ru">
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="form-label">Пароль</label>
                        <div class="position-relative">
                            <i class="bi bi-lock position-absolute" style="left: 15px; top: 12px; color: var(--text-light);"></i>
                            <input id="password" type="password" 
                                   class="form-control ps-5 @error('password') is-invalid @enderror" 
                                   name="password" required
                                   placeholder="••••••••">
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label small" for="remember">
                                Запомнить меня
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="small text-muted">Забыли пароль?</a>
                        @endif
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 py-3 mb-3">
                        Войти
                    </button>
                    
                    <div class="text-center">
                        <span class="text-muted small">Нет аккаунта?</span>
                        <a href="{{ route('register') }}" class="small fw-medium ms-1">Зарегистрироваться</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection