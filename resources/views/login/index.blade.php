@extends('layouts.app')

@section('Titulo', 'Usuarios registrados')

@section('contenido')
    <section class="card border-0 rounded-4 shadow-sm overflow-hidden">
        <header class="align-items-center d-flex flex-wrap gap-3 justify-content-between p-4 text-white"
            style="background: linear-gradient(120deg, #103b28, #1b7040);">
            <div>
                <span class="small fw-bold text-uppercase" style="color: #b9e6a6;">Administración</span>
                <h1 class="h3 fw-bold mb-1 mt-1">Usuarios registrados</h1>
                <p class="mb-0 text-white-50">Consulta y administra las cuentas registradas en el sistema.</p>
            </div>
            <a class="btn btn-light fw-semibold text-success" href="{{ route('login.create') }}">
                <i class="fas fa-user-plus me-1"></i> Crear usuario
            </a>
        </header>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Usuario</th>
                        <th>Correo</th>
                        <th class="pe-4 text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="ps-4">
                                <strong class="d-block">{{ $user->name }}</strong>
                                <small class="text-muted">Cuenta #{{ $user->id }}</small>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td class="pe-4 text-end">
                                <div class="d-inline-flex gap-2">
                                    <a class="btn btn-sm btn-outline-success" href="{{ route('login.show', $user->id) }}" aria-label="Ver usuario {{ $user->name }}" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('login.edit', $user->id) }}" aria-label="Editar usuario {{ $user->name }}" title="Editar">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form method="POST" action="{{ route('login.destroy', $user->id) }}" onsubmit="return confirm('¿Deseas eliminar a {{ $user->name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" type="submit" aria-label="Eliminar usuario {{ $user->name }}" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="py-5 text-center text-muted" colspan="3">No hay usuarios registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
