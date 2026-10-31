@extends('layouts.app')

@section('Titulo', 'Ofertas de formación')

@section('contenido')
    <div class="card border-0 shadow-sm mb-4 overflow-hidden" style="background: linear-gradient(135deg, #0d4f2f, #39A900);">
        <div class="card-body p-4 p-lg-5 text-white">
            <span class="badge bg-white text-success mb-3">Formación SENA</span>
            <h1 class="h2 fw-bold mb-2">Ofertas de formación</h1>
            <p class="mb-0 text-white-50">Consulta programas, modalidades y centros disponibles.</p>
        </div>
    </div>
    <div class="row g-4">
        @foreach ([['Tecnología', 'Análisis y desarrollo de software', 'Presencial'], ['Administración', 'Gestión administrativa', 'Mixta'], ['Industrias creativas', 'Diseño e integración multimedia', 'Presencial']] as $offer)
            <div class="col-lg-4 col-md-6">
                <article class="card border-0 shadow-sm h-100"><div class="card-body p-4">
                    <span class="badge bg-success-subtle text-success mb-3">{{ $offer[0] }}</span>
                    <h2 class="h5 fw-bold" style="color: #0d4f2f;">{{ $offer[1] }}</h2>
                    <p class="text-muted small">Centro de formación SENA</p>
                    <p class="text-muted small mb-0"><i class="fas fa-laptop me-2 text-success"></i>Modalidad {{ $offer[2] }}</p>
                </div></article>
            </div>
        @endforeach
    </div>
@endsection