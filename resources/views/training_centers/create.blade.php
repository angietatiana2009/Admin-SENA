@extends('layouts.app')

@section('Titulo', 'Registrar Centro de Formación')

@section('contenido')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">

                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

                    <!-- Encabezado corporativo verde unificado -->
                    <div class="card-header text-white py-3 px-4" style="background: linear-gradient(135deg, #0d4f2f, #39A900);">
                        <h4 class="mb-0 fw-bold fs-5">
                            <i class="fas fa-building me-2"></i>
                            Registro del Centro de Formación
                        </h4>
                    </div>

                    <div class="card-body p-4 p-md-5 bg-white">

                        <form action="{{ route('trainingcenter.salidas') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Nombre del Centro -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold" style="color: #0d4f2f;">
                                    <i class="fas fa-signature me-1"></i> Nombre del Centro
                                </label>
                                <input 
                                    type="text" 
                                    id="name"
                                    name="name" 
                                    class="form-control @error('name') is-invalid @enderror shadow-sm" 
                                    placeholder="Ej. Centro de Teleinformática y Producción Industrial"
                                    value="{{ old('name') }}"
                                    required
                                >
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Ubicación -->
                            <div class="mb-4">
                                <label for="location" class="form-label fw-bold" style="color: #0d4f2f;">
                                    <i class="fas fa-map-marker-alt me-1"></i> Ubicación
                                </label>
                                <input 
                                    type="text" 
                                    id="location"
                                    name="location" 
                                    class="form-control @error('location') is-invalid @enderror shadow-sm" 
                                    placeholder="Ej. Calle 5 Nro. 3-85, Popayán"
                                    value="{{ old('location') }}"
                                    required
                                >
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Botones de Acción proporcionales -->
                            <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                                <a href="{{ route('trainingcenter.index') }}" class="btn btn-secondary px-3 py-1" style="font-size: 0.9rem;">
                                    <i class="fas fa-arrow-left"></i> Volver
                                </a>
                                <button type="submit" class="btn text-white px-3 py-1 shadow-sm" style="background-color: #39A900; border-color: #39A900; font-size: 0.9rem;">
                                    <i class="fas fa-save"></i> Registrar Centro
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