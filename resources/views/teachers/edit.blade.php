@extends('layouts.app')

@section('Titulo', 'Editar Instructor')
@section('contenido')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Actualizar Profesor</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('teacher.update', $teachers) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Nombre
                            </label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $teachers->name) }}"
                                placeholder="Ingrese el nombre del profesor">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Correo Electrónico
                            </label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email', $teachers->email) }}"
                                placeholder="Ingrese el correo electrónico">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Área
                            </label>

                            <select name="area_id" class="form-select">
                                <option value="">Seleccione un área...</option>

                                @foreach($areas as $area)
                                    <option value="{{ $area->id }}"
                                        {{ old('area_id', $teachers->area_id) == $area->id ? 'selected' : '' }}>
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
                                        {{ old('training_centers_id', $teachers->training_centers_id) == $center->id ? 'selected' : '' }}>
                                        {{ $center->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                Cancelar
                            </a>

                            <button type="submit" class="btn btn-success">
                                Actualizar Profesor
                            </button>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection