@extends('layouts.app')

@section('Titulo', 'Editar Aprendiz')
@section('contenido')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Actualizar Aprendiz</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('aprendiz.update', $apprentices) }}" method="POST">
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
                                value="{{ old('name', $apprentices->name) }}"
                                placeholder="Ingrese el nombre del aprendiz">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Correo Electrónico
                            </label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email', $apprentices->email) }}"
                                placeholder="Ingrese el correo electrónico">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Número de Celular
                            </label>
                            <input
                                type="tel"
                                name="cell_number"
                                class="form-control"
                                value="{{ old('cell_number', $apprentices->cell_number) }}"
                                placeholder="Ingrese el número de celular">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Curso
                            </label>

                            <select name="course_id" class="form-select">
                                <option value="">Seleccione un curso...</option>

                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}"
                                        {{ old('course_id', $apprentices->course_id) == $course->id ? 'selected' : '' }}>
                                        {{ $course->numero_de_curso }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Computador
                            </label>

                            <select name="computer_id" class="form-select">
                                <option value="">Seleccione un computador...</option>

                                @foreach($computers as $computer)
                                    <option value="{{ $computer->id }}"
                                        {{ old('computer_id', $apprentices->computer_id) == $computer->id ? 'selected' : '' }}>
                                        {{ $computer->number }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                Cancelar
                            </a>

                            <button type="submit" class="btn btn-success">
                                Actualizar Aprendiz
                            </button>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection