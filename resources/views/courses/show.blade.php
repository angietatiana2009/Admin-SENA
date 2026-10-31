@extends('layouts.app')

@section('Titulo', 'Detalle del Curso')
@section('contenido')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="card-header text-white p-4" style="background: linear-gradient(135deg, #0d4f2f, #39A900);">
            <h3 class="mb-0 fw-bold">
                <i class="fas fa-book me-2"></i> Curso #{{ $course->course_number ?? $course->numero_de_curso ?? 'Sin número' }}
            </h3>
            <p class="text-white-50 mb-0 mt-1">Información detallada del curso</p>
        </div>

        <div class="card-body p-4 p-md-5 bg-white">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="fw-bold text-secondary"><i class="fas fa-hashtag me-2 text-success"></i>ID</label>
                    <div class="form-control bg-light mt-2">{{ $course->id }}</div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold text-secondary"><i class="fas fa-bookmark me-2 text-success"></i>Número del curso</label>
                    <div class="form-control mt-2">{{ $course->course_number ?? $course->numero_de_curso ?? 'No registrado' }}</div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold text-secondary"><i class="fas fa-calendar-alt me-2 text-success"></i>Fecha</label>
                    <div class="form-control mt-2">{{ \Carbon\Carbon::parse($course->day)->format('d/m/Y') }}</div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold text-secondary"><i class="fas fa-layer-group me-2 text-success"></i>Área</label>
                    <div class="form-control mt-2">{{ $course->area->name ?? 'Sin área asociada' }}</div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold text-secondary"><i class="fas fa-building me-2 text-success"></i>Centro de formación</label>
                    <div class="form-control mt-2">{{ $course->training_center->name ?? $course->trainingCenter->name ?? 'Sin centro asociado' }}</div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold text-secondary"><i class="fas fa-chalkboard-user me-2 text-success"></i>Instructores</label>
                    <div class="form-control mt-2 text-truncate">{{ $course->Teachers->pluck('name')->join(', ') ?: 'Sin instructores asignados' }}</div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold text-secondary"><i class="fas fa-clock me-2 text-success"></i>Última actualización</label>
                    <div class="form-control mt-2 text-muted bg-light">{{ \Carbon\Carbon::parse($course->updated_at)->format('d/m/Y H:i') }}</div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                <a href="{{ route('course.index') }}" class="btn btn-secondary px-4 py-2">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>

                @unless (auth()->check() && in_array(auth()->user()->role, ['teacher', 'apprentice'], true))
                    <div class="d-flex gap-2">
                        <a href="{{ route('course.edit', $course) }}" class="btn btn-warning px-4 py-2">
                            <i class="fas fa-edit me-1"></i> Editar
                        </a>
                        <form action="{{ route('course.destroy', $course) }}" method="POST" onsubmit="return confirm('¿Desea eliminar este curso?');">
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