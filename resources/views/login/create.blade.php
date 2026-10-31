@extends('layouts.app')

@section('Titulo', 'Registrar Usuario')
@section('contenido')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header text-white p-4" style="background: linear-gradient(135deg, var(--sena-green-dark, #0d4f2f), var(--sena-green, #39A900));">
                        <h3 class="mb-0 fw-bold">
                            <i class="fas fa-user-plus me-2"></i> Crear Nuevo Registro de Usuario
                        </h3>
                        <p class="text-white-50 mb-0 mt-1">Ingresa los datos para registrar el usuario en el sistema</p>
                    </div>
                    <div class="card-body p-4 p-md-5 bg-white">
                        <form action="{{ route('login.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary">
                                    <i class="fas fa-user me-1 text-success"></i> Nombre
                                </label>
                                <input type="text" name="name" class="form-control bg-light" placeholder="Nombre completo" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary">
                                    <i class="fas fa-envelope me-1 text-success"></i> Correo Electrónico
                                </label>
                                <input type="email" name="email" class="form-control bg-light" placeholder="correo@sena.edu.co" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary">
                                    <i class="fas fa-lock me-1 text-success"></i> Contraseña
                                </label>
                                <input type="password" name="password" class="form-control bg-light" placeholder="••••••••" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary">
                                    <i class="fas fa-lock me-1 text-success"></i> Confirmar Contraseña
                                </label>
                                <input type="password" name="password_confirmation" class="form-control bg-light" placeholder="Repita la contraseña" required>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                                <a href="{{ route('login') }}" class="btn btn-outline-secondary px-4 py-2">
                                    <i class="fas fa-right-to-bracket me-1"></i> Iniciar sesión
                                </a>
                                <button type="submit" class="btn btn-success px-4 py-2 shadow-sm" style="background-color: #39A900; border-color: #39A900;">
                                    <i class="fas fa-save me-2"></i> Guardar Registro
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
@endsection