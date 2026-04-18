@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="text-center mb-4">
                <h2 class="fw-medium">Создать аккаунт</h2>
                <p class="text-muted">Присоединяйтесь к Modern Home</p>
            </div>
            
            <div class="card bg-light-custom p-5">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="name" class="form-label">Имя</label>
                        <div class="position-relative">
                            <i class="bi bi-person position-absolute" style="left: 15px; top: 12px; color: var(--text-light);"></i>
                            <input id="name" type="text" 
                                   class="form-control ps-5 @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name') }}" 
                                   required autofocus
                                   placeholder="Иван Иванов">
                        </div>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <div class="position-relative">
                            <i class="bi bi-envelope position-absolute" style="left: 15px; top: 12px; color: var(--text-light);"></i>
                            <input id="email" type="email" 
                                   class="form-control ps-5 @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" 
                                   required
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
                    
                    <div class="mb-4">
                        <label for="password-confirm" class="form-label">Подтверждение пароля</label>
                        <div class="position-relative">
                            <i class="bi bi-lock position-absolute" style="left: 15px; top: 12px; color: var(--text-light);"></i>
                            <input id="password-confirm" type="password" 
                                   class="form-control ps-5" 
                                   name="password_confirmation" required
                                   placeholder="••••••••">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="agree" required>
                            <label class="form-check-label small" for="agree">
                                Я согласен с <a href="#" class="text-decoration-none">условиями</a> и <a href="#" class="text-decoration-none">политикой конфиденциальности</a>
                            </label>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 py-3 mb-3">
                        Зарегистрироваться
                    </button>
                    
                    <div class="text-center">
                        <span class="text-muted small">Уже есть аккаунт?</span>
                        <a href="{{ route('login') }}" class="small fw-medium ms-1">Войти</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection