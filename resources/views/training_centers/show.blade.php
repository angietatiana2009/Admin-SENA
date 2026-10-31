@extends('layouts.app')

@section('Titulo', 'Detalle del Centro de Formación')
@section('contenido')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="card-header text-white p-4" style="background: linear-gradient(135deg, #0d4f2f, #39A900);">
            <h3 class="mb-0 fw-bold">
                <i class="fas fa-building me-2"></i> {{ $trainingcenter->name }}
            </h3>
            <p class="text-white-50 mb-0 mt-1">Información detallada del centro de formación</p>
        </div>

        <div class="card-body p-4 p-md-5 bg-white">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="fw-bold text-secondary"><i class="fas fa-hashtag me-2 text-success"></i>ID</label>
                    <div class="form-control bg-light mt-2">{{ $trainingcenter->id }}</div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold text-secondary"><i class="fas fa-signature me-2 text-success"></i>Nombre</label>
                    <div class="form-control mt-2">{{ $trainingcenter->name }}</div>
                </div>

                <div class="col-md-12">
                    <label class="fw-bold text-secondary"><i class="fas fa-map-marker-alt me-2 text-success"></i>Ubicación</label>
                    <div class="form-control mt-2">{{ $trainingcenter->location }}</div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold text-secondary"><i class="fas fa-calendar-alt me-2 text-success"></i>Fecha de registro</label>
                    <div class="form-control mt-2 text-muted bg-light">{{ \Carbon\Carbon::parse($trainingcenter->created_at)->format('d/m/Y H:i') }}</div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold text-secondary"><i class="fas fa-clock me-2 text-success"></i>Última actualización</label>
                    <div class="form-control mt-2 text-muted bg-light">{{ \Carbon\Carbon::parse($trainingcenter->updated_at)->format('d/m/Y H:i') }}</div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                <a href="{{ route('trainingcenter.index') }}" class="btn btn-secondary px-4 py-2">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>

                @unless (auth()->check() && in_array(auth()->user()->role, ['teacher', 'apprentice'], true))
                    <div class="d-flex gap-2">
                        <a href="{{ route('trainingcenter.edit', $trainingcenter) }}" class="btn btn-warning px-4 py-2">
                            <i class="fas fa-edit me-1"></i> Editar
                        </a>
                        <form action="{{ route('trainingcenter.destroy', $trainingcenter) }}" method="POST" onsubmit="return confirm('¿Desea eliminar este centro de formación?');">
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
@endsection