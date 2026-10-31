@extends('layouts.app')

@section('Titulo', 'Registrar Computador')
@section('contenido')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-7">

            <!-- Tarjeta Principal con Estilo Elevado -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden bg-white">

                <!-- Encabezado Institucional Premium -->
                <div class="card-header py-4 px-4 text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, #0b4526 0%, #39A900 100%);">
                    <div class="position-absolute end-0 top-0 translate-middle-y opacity-10 pe-3 pt-4">
                        <i class="fas fa-laptop-code fa-5x"></i>
                    </div>
                    <div class="d-flex align-items-center position-relative z-1">
                        <div class="bg-white bg-opacity-25 p-3 rounded-3 me-3 text-white backdrop-blur">
                            <i class="fas fa-desktop fa-lg"></i>
                        </div>
                        <div>
                            <span class="badge bg-white bg-opacity-25 text-white mb-1 px-2 py-1 rounded-pill small fw-semibold">Inventario SENA</span>
                            <h4 class="mb-0 fw-bold">Registro de Nuevo Computador</h4>
                            <p class="mb-0 text-white-50 small">Complete la información técnica para el alta en el sistema</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">

                    <!-- Alerta Guía Estilizada -->
                    <div class="alert alert-light border-0 border-start border-4 border-success p-3 mb-4 rounded-3 shadow-sm bg-light-subtle" role="alert">
                        <div class="d-flex align-items-center">
                            <div class="text-success me-3 fs-5">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="small text-muted">
                                Verifique que el número de placa y la marca coincidan exactamente con las etiquetas físicas del equipo.
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('computer.model') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf

                        <div class="row g-4">
                            <!-- Número del Computador -->
                            <div class="col-12">
                                <label for="numero_computador" class="form-label fw-bold small text-secondary text-uppercase tracking-wider">
                                    <i class="fas fa-hashtag me-1 text-success"></i> Número del Computador / Placa
                                </label>
                                <div class="input-group input-group-lg shadow-sm">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="fas fa-barcode"></i>
                                    </span>
                                    <input 
                                        type="number" 
                                        id="numero"
                                        name="numero" 
                                        class="form-control border-start-0 @error('numero') is-invalid @enderror" 
                                        placeholder="Ej. 1024"
                                        value="{{ old('numero') }}"
                                        required
                                    >
                                    @error('numero')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text text-muted small mt-1">Ingrese únicamente dígitos numéricos.</div>
                            </div>

                            <!-- Marca -->
                            <div class="col-12">
                                <label for="marca" class="form-label fw-bold small text-secondary text-uppercase tracking-wider">
                                    <i class="fas fa-tag me-1 text-success"></i> Marca del Equipo
                                </label>
                                <div class="input-group input-group-lg shadow-sm">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="fas fa-laptop"></i>
                                    </span>
                                    <input 
                                        type="text" 
                                        id="marca"
                                        name="marca" 
                                        class="form-control border-start-0 @error('marca') is-invalid @enderror" 
                                        placeholder="Ej. Dell, Lenovo, HP, Asus"
                                        value="{{ old('marca') }}"
                                        required
                                    >
                                    @error('marca')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Línea Divisoria Decorativa -->
                        <hr class="my-4 text-muted opacity-25">

                        <!-- Botones de Acción Interactivos -->
                        <div class="d-flex align-items-center justify-content-between pt-2">
                            <a href="{{ route('computer.computador') }}" class="btn btn-light px-4 py-2 border text-secondary fw-semibold transition-all">
                                <i class="fas fa-arrow-left me-2"></i> Volver
                            </a>
                            <button type="submit" class="btn text-white px-4 py-2 shadow fw-semibold position-relative overflow-hidden" style="background: linear-gradient(135deg, #39A900, #2e8600); border: none;">
                                <i class="fas fa-save me-2"></i> Registrar Computador
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
<br>
@endsection