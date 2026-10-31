@extends('layouts.app')

@section('Titulo', 'Editar Curso')
@section('contenido')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Actualizar Curso</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('course.update', $courses) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Número del Curso
                            </label>
                            <input
                                type="text"
                                name="numero_de_curso"
                                class="form-control"
                                value="{{ old('numero_de_curso', $courses->numero_de_curso) }}"
                                placeholder="Ingrese el número del curso">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Fecha
                            </label>
                            <input
                                type="date"
                                name="day"
                                class="form-control"
                                value="{{ old('day', $courses->day) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Área
                            </label>

                            <select name="area_id" class="form-select">
                                <option value="">Seleccione un área...</option>

                                @foreach($areas as $area)
                                    <option value="{{ $area->id }}"
                                        {{ old('area_id', $courses->area_id) == $area->id ? 'selected' : '' }}>
                                        {{ $area->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Centro de Formación
                            </label>

                            <select name="training_centers_id" class="form-select">
                                <option value="">Seleccione un centro...</option>

                                @foreach($trainingCenters as $center)
                                    <option value="{{ $center->id }}"
                                        {{ old('training_centers_id', $courses->training_centers_id) == $center->id ? 'selected' : '' }}>
                                        {{ $center->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="teacher_ids" class="form-label fw-bold">Instructores asignados</label>
                            @php($selectedTeachers = collect(old('teacher_ids', $courses->Teachers->modelKeys())))
                            <select id="teacher_ids" name="teacher_ids[]" class="form-select" multiple size="4">
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" @selected($selectedTeachers->contains($teacher->id))>
                                        {{ $teacher->name }} · {{ $teacher->email }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Usa Ctrl (Windows) o Command (Mac) para seleccionar varios.</small>
                        </div>

                        <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                Cancelar
                            </a>

                            <button type="submit" class="btn btn-success">
                                Actualizar Curso
                            </button>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection