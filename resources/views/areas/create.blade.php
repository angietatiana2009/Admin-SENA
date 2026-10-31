@extends('layouts.app')
@section('Titulo', 'Registrar Área')
@section('contenido')
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-lg-11 col-xl-10">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    
                    <!-- Encabezado corporativo verde unificado -->
                    <div class="card-header text-white py-3 px-4" style="background: linear-gradient(135deg, #0d4f2f, #39A900);">
                        <h4 class="mb-0 fw-bold" style="font-size: 1.15rem;">
                            <i class="fas fa-layer-group me-2"></i>
                            Registrar Nueva Área Académica
                        </h4>
                        <p class="mb-0 text-white-50 mt-1" style="font-size: 0.85rem;">Complete la información detallada para registrar el área en el sistema.</p>
                    </div>

                    <div class="card-body p-4 p-md-5 bg-white">
                        <form action="{{ route('area.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Tarjeta 1: Información General -->
                            <div class="card border mb-3 shadow-sm rounded-3">
                                <div class="card-header bg-light py-2 px-3 fw-bold" style="color: #0d4f2f; font-size: 0.9rem;">
                                    <i class="fas fa-info-circle me-1"></i> Información General
                                </div>
                                <div class="card-body p-3">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-secondary" style="font-size: 0.85rem;">
                                            Nombre del Área <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            name="name"
                                            class="form-control form-control-sm @error('name') is-invalid @enderror"
                                            placeholder="Ej. Tecnologías de la Información"
                                            value="{{ old('name') }}"
                                            required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-0">
                                        <label class="form-label fw-bold text-secondary" style="font-size: 0.85rem;">
                                            Código / Sigla
                                        </label>
                                        <input
                                            type="text"
                                            name="code"
                                            class="form-control form-control-sm @error('code') is-invalid @enderror"
                                            placeholder="Ej. TICS-01"
                                            value="{{ old('code') }}">
                                        @error('code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Tarjeta 2: Configuración y Asignación -->
                            <div class="card border mb-3 shadow-sm rounded-3">
                                <div class="card-header bg-light py-2 px-3 fw-bold" style="color: #0d4f2f; font-size: 0.9rem;">
                                    <i class="fas fa-sliders-h me-1"></i> Configuración y Asignación
                                </div>
                                <div class="card-body p-3">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-secondary" style="font-size: 0.85rem;">
                                            Responsable / Instructor
                                        </label>
                                        <input
                                            type="text"
                                            name="responsible"
                                            class="form-control form-control-sm @error('responsible') is-invalid @enderror"
                                            placeholder="Nombre del encargado"
                                            value="{{ old('responsible') }}">
                                        @error('responsible')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-0">
                                        <label class="form-label fw-bold text-secondary" style="font-size: 0.85rem;">
                                            Estado Operativo
                                        </label>
                                        <select name="status" class="form-select form-select-sm">
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Activa</option>
                                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactiva</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Tarjeta 3: Detalles Adicionales -->
                            <div class="card border mb-4 shadow-sm rounded-3">
                                <div class="card-header bg-light py-2 px-3 fw-bold" style="color: #0d4f2f; font-size: 0.9rem;">
                                    <i class="fas fa-align-left me-1"></i> Detalles Adicionales
                                </div>
                                <div class="card-body p-3">
                                    <label class="form-label fw-bold text-secondary" style="font-size: 0.85rem;">
                                        Descripción Detallada <span class="text-muted fw-normal">(Opcional)</span>
                                    </label>
                                    <textarea
                                        name="description"
                                        class="form-control form-control-sm"
                                        rows="3"
                                        placeholder="Escriba una breve descripción..."
                                        style="resize: none;">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                                <a href="{{ route('area.index') }}" class="btn btn-secondary px-3 py-1" style="font-size: 0.85rem;">
                                    <i class="fas fa-arrow-left"></i> Volver
                                </a>
                                <button type="submit" class="btn text-white px-3 py-1 shadow-sm" style="background-color: #39A900; border-color: #39A900; font-size: 0.85rem;">
                                    <i class="fas fa-save"></i> Registrar Área
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