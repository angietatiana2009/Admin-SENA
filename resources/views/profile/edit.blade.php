@extends('layouts.app')

@section('Titulo', 'Editar Mis Datos')

@section('contenido')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white py-3">
                    <h4 class="mb-0"><i class="fas fa-user-edit me-2"></i>Editar Mis Datos</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nombre completo</label>
                            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Correo electrónico</label>
                            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="border-top pt-3 mt-4">
                            <h6 class="fw-bold">Cambiar contraseña</h6>
                            <p class="text-muted small">Déjala vacía si deseas conservar la actual.</p>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Nueva contraseña</label>
                                    <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" minlength="8">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control">
                                </div>
                                @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between gap-2 border-top pt-3 mt-3">
                            <a href="{{ route('profile') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i>Volver</a>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
