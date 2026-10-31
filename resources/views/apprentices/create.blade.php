@extends('layouts.app')

@section('Titulo', 'Registrar Aprendiz')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <!-- Header institucional compacto -->
            <div class="card-header py-3 px-4 text-white" style="background: linear-gradient(135deg, #0b4526 0%, #39A900 100%);">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-25 p-2 rounded-2 me-3 text-white">
                        <i class="fas fa-user-graduate fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">Registrar Nuevo Aprendiz</h5>
                        <small class="text-white-50">Complete los datos requeridos</small>
                    </div>
                </div>
            </div>

            <div class="card-body p-4 bg-white">
                <form action="{{ route('aprendiz.admin') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- Nombre Completo -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small text-secondary">
                                <i class="fas fa-user me-1" style="color: var(--sena-green);"></i> Nombre Completo
                            </label>
                                          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                              placeholder="Ingrese el nombre completo" value="{{ old('name') }}" required>
                                     @error('name')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Correo Electrónico -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small text-secondary">
                                <i class="fas fa-envelope me-1" style="color: var(--sena-green);"></i> Correo Electrónico
                            </label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   placeholder="ejemplo@correo.com" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Número de Celular -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small text-secondary">
                                <i class="fas fa-phone me-1" style="color: var(--sena-green);"></i> Número de Celular
                            </label>
                            <input type="tel" name="cell_number" class="form-control @error('cell_number') is-invalid @enderror"
                                placeholder="3001234567" value="{{ old('cell_number') }}" required>
                            @error('cell_number')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Curso -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small text-secondary">
                                <i class="fas fa-book me-1" style="color: var(--sena-green);"></i> Curso
                            </label>
                            <select name="course_id" class="form-select @error('course_id') is-invalid @enderror" required>
                                <option value="">-- Seleccione un curso --</option>
                                @if(isset($courses))
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                            {{ $course->numero_de_curso ?? 'Sin número' }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('course_id')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Computador -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small text-secondary">
                                <i class="fas fa-desktop me-1" style="color: var(--sena-green);"></i> Computador
                            </label>
                            <select name="computer_id" class="form-select @error('computer_id') is-invalid @enderror" required>
                                <option value="">-- Seleccione un computador --</option>
                                @if(isset($computers))
                                    @foreach ($computers as $computer)
                                        <option value="{{ $computer->id }}" {{ old('computer_id') == $computer->id ? 'selected' : '' }}>
                                            Equipo #{{ $computer->number ?? 'N/A' }} - {{ $computer->brand ?? 'Sin marca' }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('computer_id')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Fecha de Inicio -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold small text-secondary">
                                <i class="fas fa-calendar me-1" style="color: var(--sena-green);"></i> Fecha de Inicio
                            </label>
                            <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror"
                                   value="{{ old('start_date') }}">
                            @error('start_date')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-3 text-muted opacity-25">

                    <!-- Botones de Acción -->
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('aprendiz.index') }}" class="btn btn-light px-3 border text-secondary fw-semibold">
                            <i class="fas fa-times me-1"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary px-4 text-white fw-semibold" style="background: linear-gradient(135deg, #39A900, #2e8600); border: none;">
                            <i class="fas fa-save me-1"></i> Registrar Aprendiz
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection