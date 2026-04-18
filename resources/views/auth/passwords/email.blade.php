@extends('layouts.app')

@section('title', 'Восстановление пароля')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="text-center mb-4">
                <h2 class="fw-medium">Восстановление пароля</h2>
                <p class="text-muted">Введите email, и мы отправим ссылку для сброса</p>
            </div>
            
            <div class="card bg-light-custom p-5">
                @if (session('status'))
                    <div class="alert alert-success mb-4">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
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
                    
                    <button type="submit" class="btn btn-primary w-100 py-3 mb-3">
                        Отправить ссылку
                    </button>
                    
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="small text-muted">
                            <i class="bi bi-arrow-left me-1"></i> Вернуться ко входу
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection