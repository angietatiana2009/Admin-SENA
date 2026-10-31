@extends('layouts.app')

@section('Titulo', 'Registrar Curso')
@section('contenido')
<div class="row justify-content-center">
    <div class="col-12 col-lg-8 col-xl-7">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header text-white p-4" style="background: linear-gradient(135deg, var(--sena-green-dark, #0d4f2f), var(--sena-green, #39A900));">
                <h3 class="mb-0 fw-bold"><i class="fas fa-book me-2"></i>Registro de Curso</h3>
                <p class="text-white-50 mb-0 mt-1">Completa los datos para registrar un nuevo curso académico.</p>
            </div>
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('course.admin') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="numero_de_curso" class="form-label fw-semibold text-secondary"><i class="fas fa-hashtag me-1 text-success"></i>Número del Curso</label>
                            <input type="number" id="numero_de_curso" name="numero_de_curso" class="form-control @error('numero_de_curso') is-invalid @enderror" value="{{ old('numero_de_curso') }}" placeholder="Ej. 2873711" required>
                            @error('numero_de_curso')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="day" class="form-label fw-semibold text-secondary"><i class="fas fa-calendar-days me-1 text-success"></i>Fecha de Inicio</label>
                            <input type="date" id="day" name="day" class="form-control @error('day') is-invalid @enderror" value="{{ old('day') }}" required>
                            @error('day')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="area_id" class="form-label fw-semibold text-secondary"><i class="fas fa-layer-group me-1 text-success"></i>Área Académica</label>
                            <select id="area_id" name="area_id" class="form-select @error('area_id') is-invalid @enderror" required>
                                <option value="">Seleccione un área</option>
                                @foreach($areas as $area)
                                    <option value="{{ $area->id }}" @selected(old('area_id') == $area->id)>{{ $area->name }}</option>
                                @endforeach
                            </select>
                            @error('area_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="training_centers_id" class="form-label fw-semibold text-secondary"><i class="fas fa-building me-1 text-success"></i>Centro de Formación</label>
                            <select id="training_centers_id" name="training_centers_id" class="form-select @error('training_centers_id') is-invalid @enderror" required>
                                <option value="">Seleccione un centro</option>
                                @foreach($trainingCenters as $training)
                                    <option value="{{ $training->id }}" @selected(old('training_centers_id') == $training->id)>{{ $training->name }}</option>
                                @endforeach
                            </select>
                            @error('training_centers_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label for="teacher_ids" class="form-label fw-semibold text-secondary"><i class="fas fa-chalkboard-user me-1 text-success"></i>Instructores asignados</label>
                            <select id="teacher_ids" name="teacher_ids[]" class="form-select" multiple size="4">
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" @selected(collect(old('teacher_ids', []))->contains($teacher->id))>
                                        {{ $teacher->name }} · {{ $teacher->email }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Usa Ctrl (Windows) o Command (Mac) para seleccionar varios.</small>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 flex-wrap border-top pt-4 mt-4">
                        <a href="{{ route('course.index') }}" class="btn btn-light border"><i class="fas fa-arrow-left"></i>Volver</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Registrar Curso</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection