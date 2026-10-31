@extends('layouts.app')

@section('Titulo', 'Editar Centro de Formación')
@section('contenido')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow border-0 rounded-4 overflow-hidden">
                <div class="card-header text-white py-3 px-4" style="background: linear-gradient(135deg, #0d4f2f, #39A900);">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-building me-2"></i> Editar Centro de Formación
                    </h4>
                    <p class="mb-0 text-white-50 mt-1 small">Actualice la información del centro seleccionado.</p>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('trainingcenter.update', $trainingcenter) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label fw-bold" style="color: #0d4f2f;">
                                <i class="fas fa-signature me-1"></i> Nombre
                            </label>
                            <input
                                type="text"
                                name="name"
                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                value="{{ old('name', $trainingcenter->name) }}"
                                placeholder="Ingrese el nombre del centro"
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold" style="color: #0d4f2f;">
                                <i class="fas fa-map-marker-alt me-1"></i> Ubicación
                            </label>
                            <input
                                type="text"
                                name="location"
                                class="form-control form-control-lg @error('location') is-invalid @enderror"
                                value="{{ old('location', $trainingcenter->location) }}"
                                placeholder="Ingrese la ubicación"
                                required>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                            <a href="{{ route('trainingcenter.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Volver
                            </a>

                            <button type="submit" class="btn btn-success" style="background-color: #39A900; border-color: #39A900;">
                                <i class="fas fa-save me-1"></i> Actualizar Centro
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection