@extends('layouts.app')

@section('Titulo', 'Registrar Instructor')
@section('contenido')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    
                    <!-- Cabecera de la tarjeta con estilo SENA -->
                    <div class="card-header text-white p-4" style="background: linear-gradient(135deg, var(--sena-green-dark, #0d4f2f), var(--sena-green, #39A900));">
                        <h3 class="mb-0 fw-bold">
                            <i class="fas fa-chalkboard-user me-2"></i>
                            Registro de Instructor
                        </h3>
                        <p class="text-white-50 mb-0 mt-1">Completa los datos para dar de alta un nuevo instructor en el sistema</p>
                    </div>

                    <div class="card-body p-4 p-md-5 bg-white">
                        <form action="{{ route('teacher.admin') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Campo Nombre -->
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary">
                                    <i class="fas fa-user me-1 text-success"></i> Nombre del Instructor
                                </label>
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control bg-light"
                                    placeholder="Ingrese el nombre completo"
                                    required>
                            </div>

                            <!-- Campo Correo -->
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary">
                                    <i class="fas fa-envelope me-1 text-success"></i> Correo Electrónico
                                </label>
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control bg-light"
                                    placeholder="ejemplo@sena.edu.co"
                                    required>
                            </div>

                            <!-- Selector de Área -->
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary">
                                    <i class="fas fa-layer-group me-1 text-success"></i> Área
                                </label>
                                <select name="area_id" id="area_id" class="form-select bg-light" required>
                                    <option value="">Seleccione un área</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}">
                                            {{ $area->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Selector de Centro de Formación -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary">
                                    <i class="fas fa-building me-1 text-success"></i> Centro de Formación
                                </label>
                                <select name="training_centers_id" class="form-select bg-light" required>
                                    <option value="">Seleccione un centro de formación</option>
                                    @foreach ($trainingCenters as $training)
                                        <option value="{{ $training->id }}">
                                            {{ $training->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Botones de Acción con tamaño normal y proporcionado -->
                            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                                <a href="{{ route('teacher.registro') }}" class="btn btn-secondary px-4 py-2">
                                    <i class="fas fa-arrow-left me-1"></i> Volver
                                </a>
                                <button type="submit" class="btn btn-success px-4 py-2 shadow-sm" style="background-color: #39A900; border-color: #39A900;">
                                    <i class="fas fa-save me-2"></i> Registrar Instructor
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