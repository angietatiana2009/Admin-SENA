@extends('layouts.app')
@section('Titulo', 'Listado de Aprendices')
@section('contenido')
    @php($readOnlyRole = auth()->check() && in_array(auth()->user()->role, ['teacher', 'apprentice'], true))
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 style="color: #0d4f2f; font-weight: 800;">
                    <i class="fas fa-users"></i> Gestión de Aprendices
                </h2>
                @unless ($readOnlyRole)
                    <a href="{{ route('aprendiz.registro') }}" class="btn btn-primary" style="background-color: #39A900; border-color: #39A900;">
                        <i class="fas fa-plus"></i> Nuevo Aprendiz
                    </a>
                @endunless
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-exclamation-triangle"></i> Error:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            @if($apprentices->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead style="background: linear-gradient(135deg, #0d4f2f, #39A900); color: white;">
                            <tr>
                                <th><i class="fas fa-hashtag"></i> #</th>
                                <th><i class="fas fa-user"></i> Nombre</th>
                                <th><i class="fas fa-envelope"></i> Correo</th>
                                <th><i class="fas fa-phone"></i> Teléfono</th>
                                <th><i class="fas fa-book"></i> Curso</th>
                                <th><i class="fas fa-desktop"></i> Computador</th>
                                <th><i class="fas fa-cogs"></i> Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apprentices as $apprentice)
                                <tr>
                                    <td><strong>{{ $loop->iteration }}</strong></td>
                                    <td>{{ $apprentice->name ?? 'N/A' }}</td>
                                    <td>{{ $apprentice->email ?? 'N/A' }}</td>
                                    <td>{{ $apprentice->cell_number ?? 'N/A' }}</td>
                                    <td>{{ $apprentice->course->numero_de_curso ?? 'N/A' }}</td>
                                    <td>{{ $apprentice->computer->brand ?? 'N/A' }}</td>
                                    <td>
                                        <div class="table-actions" role="group" aria-label="Acciones del aprendiz">
                                            <a href="{{ route('apprentice.show', $apprentice->id) }}" class="btn btn-primary" title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @unless ($readOnlyRole)
                                                <a href="{{ route('aprendiz.edit', $apprentice->id) }}" class="btn btn-warning" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('aprendiz.destroy', $apprentice->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Desea eliminar este aprendiz?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" title="Eliminar">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endunless
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info border-0 text-center py-5">
                    <i class="fas fa-info-circle" style="font-size: 2rem; color: #3b82f6; margin-bottom: 15px; display: block;"></i>
                    <h5>No hay aprendices registrados</h5>
                    <p class="mb-3">Aún no hay aprendices en el sistema.</p>
                    @unless ($readOnlyRole)
                        <a href="{{ route('aprendiz.registro') }}" class="btn btn-primary" style="background-color: #39A900; border-color: #39A900;">
                            <i class="fas fa-plus"></i> Registrar Primer Aprendiz
                        </a>
                    @endunless
                </div>
            @endif
        </div>
    </div>
@endsection