@extends('layouts.app')

@section('Titulo', 'Detalle del Área')
@section('contenido')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header text-white p-4" style="background: linear-gradient(135deg, #0d4f2f, #39A900);">
                        <h3 class="mb-0 fw-bold">
                            <i class="fas fa-layer-group me-2"></i> {{ $area->name }}
                        </h3>
                        <p class="text-white-50 mb-0 mt-1">Información detallada del área académica</p>
                    </div>

                    <div class="card-body p-4 p-md-5 bg-white">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="fw-bold text-secondary"><i class="fas fa-hashtag me-2 text-success"></i>ID</label>
                                <div class="form-control bg-light mt-2">{{ $area->id }}</div>
                            </div>

                            <div class="col-md-6">
                                <label class="fw-bold text-secondary"><i class="fas fa-tag me-2 text-success"></i>Nombre</label>
                                <div class="form-control mt-2">{{ $area->name }}</div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="fw-bold text-secondary"><i class="fas fa-align-left me-2 text-success"></i>Descripción</label>
                            <div class="form-control mt-2" style="min-height: 110px; white-space: pre-line;">
                                {{ $area->description ?? 'Sin descripción registrada.' }}
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                            <a href="{{ route('area.index') }}" class="btn btn-secondary px-4 py-2">
                                <i class="fas fa-arrow-left me-1"></i> Volver
                            </a>

                            @unless (auth()->check() && in_array(auth()->user()->role, ['teacher', 'apprentice'], true))
                                <div class="d-flex gap-2">
                                    <a href="{{ route('area.edit', $area) }}" class="btn btn-warning px-4 py-2">
                                        <i class="fas fa-edit me-1"></i> Editar
                                    </a>
                                    <form action="{{ route('area.destroy', $area) }}" method="POST" onsubmit="return confirm('¿Desea eliminar esta área?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger px-4 py-2">
                                            <i class="fas fa-trash me-1"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            @endunless
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
@endsection