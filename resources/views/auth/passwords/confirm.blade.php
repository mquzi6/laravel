@extends('layouts.app')

@section('title', 'Подтверждение пароля')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="text-center mb-4">
                <h2 class="fw-medium">Подтверждение пароля</h2>
                <p class="text-muted">Для продолжения введите ваш пароль</p>
            </div>
            
            <div class="card bg-light-custom p-5">
                <p class="text-muted mb-4">
                    Это защищённая область. Пожалуйста, подтвердите ваш пароль перед продолжением.
                </p>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="password" class="form-label">Пароль</label>
                        <div class="position-relative">
                            <i class="bi bi-lock position-absolute" style="left: 15px; top: 12px; color: var(--text-light);"></i>
                            <input id="password" type="password" 
                                   class="form-control ps-5 @error('password') is-invalid @enderror" 
                                   name="password" required autofocus
                                   placeholder="••••••••">
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 py-3 mb-3">
                        Подтвердить
                    </button>
                    
                    @if (Route::has('password.request'))
                        <div class="text-center">
                            <a href="{{ route('password.request') }}" class="small text-muted">
                                Забыли пароль?
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection