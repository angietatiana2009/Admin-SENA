@extends('layouts.app')

@section('Titulo', 'Editar Usuario')
@section('contenido')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header text-white p-4" style="background: linear-gradient(135deg, var(--sena-green-dark, #0d4f2f), var(--sena-green, #39A900));">
                        <h3 class="mb-0 fw-bold">
                            <i class="fas fa-user-edit me-2"></i> Editar Registro de Usuario
                        </h3>
                        <p class="text-white-50 mb-0 mt-1">Modifica los datos necesarios del usuario</p>
                    </div>
                    <div class="card-body p-4 p-md-5 bg-white">
                        <form action="{{ route('login.update', $login->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary">
                                    <i class="fas fa-user me-1 text-success"></i> Nombre
                                </label>
                                <input type="text" name="name" value="{{ $login->name }}" class="form-control bg-light" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary">
                                    <i class="fas fa-envelope me-1 text-success"></i> Correo Electrónico
                                </label>
                                <input type="email" name="email" value="{{ $login->email }}" class="form-control bg-light" required>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                                <a href="{{ route('login.index') }}" class="btn btn-secondary px-4 py-2">
                                    <i class="fas fa-arrow-left me-1"></i> Volver
                                </a>
                                <button type="submit" class="btn btn-success px-4 py-2 shadow-sm" style="background-color: #39A900; border-color: #39A900;">
                                    <i class="fas fa-sync-alt me-2"></i> Actualizar Registro
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