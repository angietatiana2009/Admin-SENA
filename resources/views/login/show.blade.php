@extends('layouts.app')

@section('Titulo', 'Detalle del Usuario')
@section('contenido')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header text-white p-4" style="background: linear-gradient(135deg, var(--sena-green-dark, #0d4f2f), var(--sena-green, #39A900));">
                        <h3 class="mb-0 fw-bold">
                            <i class="fas fa-id-card me-2"></i> Detalle del Usuario
                        </h3>
                        <p class="text-white-50 mb-0 mt-1">Información detallada del registro</p>
                    </div>
                    <div class="card-body p-4 p-md-5 bg-white">
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item py-3">
                                <strong class="text-secondary"><i class="fas fa-user me-2 text-success"></i> Nombre:</strong>
                                <span class="float-end">{{ $login->name }}</span>
                            </li>
                            <li class="list-group-item py-3">
                                <strong class="text-secondary"><i class="fas fa-envelope me-2 text-success"></i> Correo:</strong>
                                <span class="float-end">{{ $login->email }}</span>
                            </li>
                            <li class="list-group-item py-3">
                                <strong class="text-secondary"><i class="fas fa-calendar-alt me-2 text-success"></i> Fecha de Creación:</strong>
                                <span class="float-end">{{ $login->created_at }}</span>
                            </li>
                        </ul>
                        <div class="d-grid">
                            <a href="{{ route('login.index') }}" class="btn btn-secondary py-2">
                                <i class="fas fa-arrow-left me-1"></i> Volver a la Lista
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
@endsection