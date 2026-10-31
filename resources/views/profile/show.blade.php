@extends('layouts.app')

@section('Titulo', 'Mi Perfil')

@section('contenido')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white py-3">
                    <h4 class="mb-0"><i class="fas fa-id-card me-2"></i>Mi Perfil</h4>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="profile-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                        <div>
                            <h3 class="mb-1">{{ $user->name }}</h3>
                            <p class="text-muted mb-0">{{ $user->email }}</p>
                        </div>
                    </div>
                    <dl class="row mb-4">
                        <dt class="col-sm-4">Nombre completo</dt>
                        <dd class="col-sm-8">{{ $user->name }}</dd>
                        <dt class="col-sm-4">Correo electrónico</dt>
                        <dd class="col-sm-8">{{ $user->email }}</dd>
                    </dl>
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                        <i class="fas fa-user-edit me-1"></i> Editar datos
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .profile-avatar {
            width: 64px;
            height: 64px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: #39A900;
            color: #fff;
            font-size: 1.7rem;
            font-weight: 700;
        }
    </style>
@endsection
