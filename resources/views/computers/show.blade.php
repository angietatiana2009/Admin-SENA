@extends('layouts.app')

@section('Titulo', 'Detalle del Computador')
@section('contenido')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="card-header text-white p-4" style="background: linear-gradient(135deg, #0d4f2f, #39A900);">
            <h3 class="mb-0 fw-bold">
                <i class="fas fa-desktop me-2"></i> {{ $computer->brand }}
            </h3>
            <p class="text-white-50 mb-0 mt-1">Información detallada del computador</p>
        </div>

        <div class="card-body p-4 p-md-5 bg-white">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="fw-bold text-secondary"><i class="fas fa-hashtag me-2 text-success"></i>ID</label>
                    <div class="form-control bg-light mt-2">{{ $computer->id }}</div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold text-secondary"><i class="fas fa-barcode me-2 text-success"></i>Número</label>
                    <div class="form-control mt-2">{{ $computer->number }}</div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold text-secondary"><i class="fas fa-tag me-2 text-success"></i>Marca</label>
                    <div class="form-control mt-2">{{ $computer->brand }}</div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold text-secondary"><i class="fas fa-calendar-alt me-2 text-success"></i>Fecha de creación</label>
                    <div class="form-control mt-2 text-muted bg-light">{{ \Carbon\Carbon::parse($computer->created_at)->format('d/m/Y H:i') }}</div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                <a href="{{ route('computer.index') }}" class="btn btn-secondary px-4 py-2">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>

                <div class="d-flex gap-2">
                    <a href="{{ route('computer.edit', $computer) }}" class="btn btn-warning px-4 py-2">
                        <i class="fas fa-edit me-1"></i> Editar
                    </a>
                    <form action="{{ route('computer.destroy', $computer) }}" method="POST" onsubmit="return confirm('¿Desea eliminar este computador?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger px-4 py-2">
                            <i class="fas fa-trash me-1"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection