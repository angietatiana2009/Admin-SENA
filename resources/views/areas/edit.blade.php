@extends('layouts.app')
@section('Titulo', 'Editar Área')
@section('contenido')
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header text-white py-3 px-4" style="background: linear-gradient(135deg, #0d4f2f, #39A900);">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-edit me-2"></i>
                        Editar Área Académica
                    </h4>
                    <p class="mb-0 text-white-50 mt-1 small">Actualice la información del área seleccionada.</p>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('area.update', $areas) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold" style="color: #0d4f2f;">
                                <i class="fas fa-layer-group me-1"></i> Nombre del Área
                            </label>
                            <input
                                type="text"
                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                id="name"
                                name="name"
                                value="{{ old('name', $areas->name) }}"
                                placeholder="Ingrese el nombre del área"
                                required>
                            @error('name')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold" style="color: #0d4f2f;">
                                <i class="fas fa-align-left me-1"></i> Descripción
                            </label>
                            <textarea
                                class="form-control form-control-lg"
                                id="description"
                                name="description"
                                rows="4"
                                placeholder="Ingrese una descripción"
                                style="resize: none;">{{ old('description', $areas->description ?? '') }}</textarea>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end pt-2 border-top">
                            <a href="{{ route('area.index') }}" class="btn btn-secondary btn-lg">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg" style="background-color: #39A900; border-color: #39A900;">
                                <i class="fas fa-save"></i> Actualizar Área
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection