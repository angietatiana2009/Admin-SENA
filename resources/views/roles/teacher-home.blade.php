@extends('layouts.app')

@section('Titulo', 'Espacio del Instructor')

@section('contenido')
    <main class="teacher-dashboard">
        <section class="teacher-welcome">
            <div>
                <span class="teacher-kicker"><i class="fas fa-chalkboard-user me-2"></i>ESPACIO DEL INSTRUCTOR</span>
                <h1>Hola, {{ auth()->user()->name }}</h1>
                <p>Consulta la oferta formativa y mantente conectado con la comunidad académica.</p>
            </div>
            <div class="teacher-welcome-icon" aria-hidden="true"><i class="fas fa-person-chalkboard"></i></div>
        </section>

        <section class="teacher-metrics" aria-label="Resumen académico">
            <a class="teacher-metric" href="{{ route('course.index') }}">
                <span class="teacher-metric-icon"><i class="fas fa-book-open"></i></span>
                <span><strong>{{ $courseCount }}</strong><small>Cursos disponibles</small></span>
                <i class="fas fa-arrow-up-right-from-square teacher-metric-arrow"></i>
            </a>
            <a class="teacher-metric" href="{{ route('aprendiz.index') }}">
                <span class="teacher-metric-icon"><i class="fas fa-user-graduate"></i></span>
                <span><strong>{{ $apprenticeCount }}</strong><small>Aprendices registrados</small></span>
                <i class="fas fa-arrow-up-right-from-square teacher-metric-arrow"></i>
            </a>
            <a class="teacher-metric" href="{{ route('area.index') }}">
                <span class="teacher-metric-icon"><i class="fas fa-layer-group"></i></span>
                <span><strong>{{ $areaCount }}</strong><small>Áreas de formación</small></span>
                <i class="fas fa-arrow-up-right-from-square teacher-metric-arrow"></i>
            </a>
        </section>

        <section class="teacher-course-section">
            <div class="teacher-section-heading">
                <div>
                    <span class="teacher-kicker">ACTUALIZACIÓN ACADÉMICA</span>
                    <h2>Cursos de formación</h2>
                </div>
                <a href="{{ route('course.index') }}">Ver catálogo <i class="fas fa-arrow-right ms-1"></i></a>
            </div>

            @forelse ($courses as $course)
                <a class="teacher-course-row" href="{{ route('course.show', $course->id) }}">
                    <span class="teacher-course-icon"><i class="fas fa-book"></i></span>
                    <span class="teacher-course-main">
                        <strong>Curso {{ $course->numero_de_curso }}</strong>
                        <small>{{ $course->area->name ?? 'Área por definir' }} · {{ $course->training_center->name ?? 'Centro por definir' }}</small>
                    </span>
                    <span class="teacher-course-date">{{ $course->day }}</span>
                    <i class="fas fa-chevron-right"></i>
                </a>
            @empty
                <div class="teacher-empty">
                    <i class="fas fa-book-open"></i>
                    <p>No hay cursos disponibles por el momento.</p>
                </div>
            @endforelse
        </section>

        <section class="teacher-quick-links" aria-label="Accesos para instructores">
            <a href="{{ route('teacher.index') }}"><i class="fas fa-people-group"></i><span>Directorio de instructores</span><i class="fas fa-arrow-right"></i></a>
            <a href="{{ route('trainingcenter.index') }}"><i class="fas fa-building"></i><span>Centros de formación</span><i class="fas fa-arrow-right"></i></a>
        </section>
    </main>

    <style>
        .teacher-dashboard { --teacher-ink: #17384b; --teacher-blue: #17667b; --teacher-cyan: #2fa6b7; color: var(--teacher-ink); }
        .teacher-welcome { align-items: center; background: linear-gradient(120deg, #103c54, #17667b 65%, #2fa6b7); border-radius: 22px; color: #fff; display: flex; justify-content: space-between; margin-bottom: 1.4rem; min-height: 205px; overflow: hidden; padding: clamp(1.5rem, 4vw, 3rem); position: relative; }
        .teacher-welcome h1 { font-size: clamp(1.8rem, 4vw, 2.7rem); font-weight: 800; margin: .7rem 0 .45rem; }
        .teacher-welcome p { color: rgba(255,255,255,.82); margin: 0; max-width: 620px; }
        .teacher-kicker { color: #b6edf0; font-size: .75rem; font-weight: 800; letter-spacing: .12em; }
        .teacher-welcome-icon { color: rgba(255,255,255,.16); font-size: clamp(5rem, 12vw, 9rem); padding: 0 1.5rem; }
        .teacher-metrics { display: grid; gap: 1rem; grid-template-columns: repeat(3, minmax(0, 1fr)); margin-bottom: 1.5rem; }
        .teacher-metric { align-items: center; background: #fff; border: 1px solid #dcebef; border-radius: 16px; box-shadow: 0 8px 22px rgba(16,60,84,.06); color: inherit; display: flex; gap: .85rem; min-width: 0; padding: 1rem; text-decoration: none; transition: transform .2s, box-shadow .2s; }
        .teacher-metric:hover { box-shadow: 0 12px 28px rgba(16,60,84,.12); color: inherit; transform: translateY(-3px); }
        .teacher-metric-icon { align-items: center; background: #e6f5f6; border-radius: 12px; color: var(--teacher-blue); display: inline-flex; flex: 0 0 44px; height: 44px; justify-content: center; }
        .teacher-metric strong, .teacher-metric small { display: block; }
        .teacher-metric strong { font-size: 1.45rem; line-height: 1.2; }
        .teacher-metric small { color: #647784; font-size: .78rem; }
        .teacher-metric-arrow { color: #84aab2; margin-left: auto; }
        .teacher-course-section { background: #fff; border: 1px solid #e1ecef; border-radius: 18px; padding: clamp(1rem, 2.5vw, 1.6rem); }
        .teacher-section-heading { align-items: end; display: flex; justify-content: space-between; margin-bottom: 1rem; }
        .teacher-section-heading h2 { font-size: 1.35rem; font-weight: 800; margin: .25rem 0 0; }
        .teacher-section-heading a { color: var(--teacher-blue); font-size: .9rem; font-weight: 700; text-decoration: none; }
        .teacher-section-heading .teacher-kicker { color: var(--teacher-blue); }
        .teacher-course-row { align-items: center; border-top: 1px solid #edf2f4; color: inherit; display: flex; gap: .9rem; padding: .9rem .25rem; text-decoration: none; }
        .teacher-course-row:hover { color: var(--teacher-blue); }
        .teacher-course-icon { align-items: center; background: #eaf5f7; border-radius: 11px; color: var(--teacher-blue); display: inline-flex; flex: 0 0 42px; height: 42px; justify-content: center; }
        .teacher-course-main { flex: 1; min-width: 0; }
        .teacher-course-main strong, .teacher-course-main small { display: block; overflow: hidden; text-overflow: ellipsis; }
        .teacher-course-main small { color: #6c7d86; }
        .teacher-course-date { color: #607680; font-size: .85rem; white-space: nowrap; }
        .teacher-course-row > .fa-chevron-right { color: #8eaab1; font-size: .8rem; }
        .teacher-empty { color: #6c7d86; padding: 2rem 1rem; text-align: center; }
        .teacher-empty i { color: var(--teacher-cyan); font-size: 2rem; }
        .teacher-quick-links { display: grid; gap: .8rem; grid-template-columns: repeat(2, minmax(0, 1fr)); margin-top: 1rem; }
        .teacher-quick-links a { align-items: center; background: #eaf5f7; border-radius: 12px; color: var(--teacher-ink); display: flex; gap: .75rem; padding: .95rem 1rem; text-decoration: none; }
        .teacher-quick-links a > i:first-child { color: var(--teacher-blue); }
        .teacher-quick-links a > i:last-child { color: var(--teacher-blue); margin-left: auto; }
        @media (max-width: 700px) { .teacher-metrics { grid-template-columns: 1fr; } .teacher-welcome-icon { display: none; } .teacher-course-date { display: none; } .teacher-quick-links { grid-template-columns: 1fr; } }
    </style>
@endsection
