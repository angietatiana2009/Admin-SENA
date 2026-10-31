@extends('layouts.app')

@section('Titulo', 'Detalle del Aprendiz')
@section('contenido')
<div class="container mt-5">

    <div class="card shadow-lg border-0">

        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">
                Aprendiz: {{ $aprendiz->name }}
            </h3>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="fw-bold">ID</label>
                    <div class="form-control bg-light">
                        {{ $aprendiz->id }}
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Nombre Completo</label>
                    <div class="form-control">
                        {{ $aprendiz->name }}
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Correo Electronico </label>
                    <div class="form-control">
                        {{ $aprendiz->email }}
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Numero de Celular</label>
                    <div class="form-control">
                        {{ $aprendiz->cell_number }}
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="fw-bold">ID de Curso </label>
                    <div class="form-control">
                        {{ $aprendiz->course_id }}
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="fw-bold">ID de Computador</label>
                    <div class="form-control">
                        {{ $aprendiz->computer_id }}
                    </div>
                </div>

            </div>

            <hr class="my-4">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Fecha de registro</label>
                    <div class="form-control text-muted bg-light">
                        {{ \Carbon\Carbon::parse($aprendiz->created_at)->format('d/m/Y H:i') }}
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="fw-bold">Última actualización</label>
                    <div class="form-control text-muted bg-light">
                        {{ \Carbon\Carbon::parse($aprendiz->updated_at)->format('d/m/Y H:i') }}
                    </div>
                </div>

            </div>

            <div class="mt-4 text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
            </div>

        </div>

    </div>

</div>
@endsection