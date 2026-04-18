@extends('layouts.app')

@section('title', 'Сброс пароля')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="text-center mb-4">
                <h2 class="fw-medium">Новый пароль</h2>
                <p class="text-muted">Придумайте новый пароль для вашего аккаунта</p>
            </div>
            
            <div class="card bg-light-custom p-5">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    
                    <input type="hidden" name="token" value="{{ $token }}">
                    
                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <div class="position-relative">
                            <i class="bi bi-envelope position-absolute" style="left: 15px; top: 12px; color: var(--text-light);"></i>
                            <input id="email" type="email" 
                                   class="form-control ps-5 @error('email') is-invalid @enderror" 
                                   name="email" value="{{ $email ?? old('email') }}" 
                                   required readonly
                                   style="background-color: #f5f5f5;">
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="form-label">Новый пароль</label>
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
                    
                    <div class="mb-4">
                        <label for="password-confirm" class="form-label">Подтвердите пароль</label>
                                               <div class="position-relative">
                            <i class="bi bi-lock position-absolute" style="left: 15px; top: 12px; color: var(--text-light);"></i>
                            <input id="password-confirm" type="password" 
                                   class="form-control ps-5" 
                                   name="password_confirmation" required
                                   placeholder="••••••••">
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 py-3">
                        Сохранить новый пароль
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection