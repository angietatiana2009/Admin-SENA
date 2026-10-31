@extends('layouts.app')

@section('Titulo', 'Gestión de Computadores')

@section('contenido')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-success mb-0"><i class="fas fa-desktop me-2"></i>Computadores</h2>
        <a href="{{ route('computer.computador') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Nuevo computador
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Número</th>
                            <th>Marca</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($computers as $computer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $computer->number }}</td>
                                <td>{{ $computer->brand }}</td>
                                <td class="text-end">
                                    <a href="{{ route('computer.show', $computer->id) }}" class="btn btn-sm btn-outline-primary" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('computer.edit', $computer->id) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('computer.destroy', $computer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Desea eliminar este computador?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No hay computadores registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
