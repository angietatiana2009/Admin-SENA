@extends('layouts.app')

@section('Titulo', 'Iniciar sesión')

@section('contenido')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header text-white p-4" style="background: linear-gradient(135deg, var(--sena-green-dark, #0d4f2f), var(--sena-green, #39A900));">
                    <h3 class="mb-0 fw-bold"><i class="fas fa-right-to-bracket me-2"></i>Iniciar sesión</h3>
                    <p class="text-white-50 mb-0 mt-1">Ingresa con tu correo y contraseña.</p>
                </div>
                <div class="card-body p-4 p-md-5 bg-white">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('login.authenticate') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Correo electrónico</label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                autocomplete="email"
                                required
                                autofocus
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Contraseña</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                autocomplete="current-password"
                                required
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check mb-4">
                            <input id="remember" name="remember" type="checkbox" class="form-check-input" value="1">
                            <label for="remember" class="form-check-label">Mantener sesión iniciada</label>
                        </div>

                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 border-top pt-3">
                            <a href="{{ route('login.create') }}">¿No tienes cuenta? Regístrate</a>
                            <button type="submit" class="btn btn-success px-4" style="background-color: #39A900; border-color: #39A900;">
                                <i class="fas fa-right-to-bracket me-2"></i>Entrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
