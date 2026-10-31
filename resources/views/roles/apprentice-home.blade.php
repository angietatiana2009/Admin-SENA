@extends('layouts.app')

@section('Titulo', 'Mi espacio de aprendizaje')

@section('contenido')
    <main class="apprentice-dashboard">
        <section class="apprentice-welcome">
            <div class="apprentice-welcome-copy">
                <span class="apprentice-kicker"><i class="fas fa-graduation-cap me-2"></i>MI ESPACIO SENA</span>
                <h1>¡Sigue aprendiendo, {{ auth()->user()->name }}!</h1>
                <p>Explora cursos, encuentra oportunidades y mantente al día con la comunidad.</p>
                <a href="{{ route('course.index') }}" class="apprentice-primary-action">
                    Explorar cursos <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="apprentice-welcome-art" aria-hidden="true">
                <span class="apprentice-art-circle apprentice-art-circle-one"></span>
                <span class="apprentice-art-circle apprentice-art-circle-two"></span>
                <i class="fas fa-book-open-reader"></i>
            </div>
        </section>

        <section class="apprentice-course-callout">
            <span class="apprentice-course-symbol"><i class="fas fa-compass"></i></span>
            <div>
                <span class="apprentice-kicker">TU SIGUIENTE PASO</span>
                <h2>{{ $courseCount }} cursos en el catálogo</h2>
                <p>Revisa la oferta disponible y encuentra una formación que impulse tus metas.</p>
            </div>
            <a href="{{ route('course.index') }}" aria-label="Ver todos los cursos"><i class="fas fa-arrow-right"></i></a>
        </section>

        <section class="apprentice-community">
            <div class="apprentice-section-title">
                <div>
                    <span class="apprentice-kicker">MÁS PARA TI</span>
                    <h2>Conecta con tu comunidad</h2>
                </div>
                <i class="fas fa-sparkles" aria-hidden="true"></i>
            </div>
            <div class="apprentice-community-grid">
                <a class="apprentice-community-card apprentice-news-card" href="{{ route('news.index') }}">
                    <span class="apprentice-community-icon"><i class="fas fa-newspaper"></i></span>
                    <span class="apprentice-community-copy">
                        <strong>Noticias SENA</strong>
                        <small>Novedades e historias de la comunidad.</small>
                    </span>
                    <i class="fas fa-arrow-right apprentice-card-arrow"></i>
                </a>
                <a class="apprentice-community-card apprentice-offers-card" href="{{ route('offers.index') }}">
                    <span class="apprentice-community-icon"><i class="fas fa-briefcase"></i></span>
                    <span class="apprentice-community-copy">
                        <strong>Ofertas de formación</strong>
                        <small>Descubre nuevas oportunidades para crecer.</small>
                    </span>
                    <i class="fas fa-arrow-right apprentice-card-arrow"></i>
                </a>
            </div>
        </section>

        <section class="apprentice-latest">
            <div class="apprentice-section-title">
                <div>
                    <span class="apprentice-kicker">PARA EXPLORAR</span>
                    <h2>Formaciones recientes</h2>
                </div>
                <a href="{{ route('course.index') }}">Ver catálogo</a>
            </div>
            @forelse ($courses as $course)
                <a class="apprentice-course-card" href="{{ route('course.show', $course->id) }}">
                    <span class="apprentice-course-icon"><i class="fas fa-book"></i></span>
                    <span class="apprentice-course-copy">
                        <strong>Curso {{ $course->numero_de_curso }}</strong>
                        <small>{{ $course->area->name ?? 'Área por definir' }} · {{ $course->training_center->name ?? 'Centro por definir' }}</small>
                    </span>
                    <span class="apprentice-course-date">{{ $course->day }}</span>
                    <i class="fas fa-chevron-right"></i>
                </a>
            @empty
                <div class="apprentice-empty">
                    <i class="fas fa-book-open"></i>
                    <p>Pronto encontrarás nuevas formaciones para explorar.</p>
                </div>
            @endforelse
        </section>
    </main>

    <style>
        .apprentice-dashboard { --apprentice-ink: #29233e; --apprentice-purple: #58418a; --apprentice-gold: #f2ad48; color: var(--apprentice-ink); }
        .apprentice-welcome { align-items: center; background: linear-gradient(115deg, #352451, #58418a 66%, #7256a5); border-radius: 24px; color: #fff; display: flex; justify-content: space-between; margin-bottom: 1.25rem; min-height: 260px; overflow: hidden; padding: clamp(1.5rem, 4vw, 3.2rem); position: relative; }
        .apprentice-welcome-copy { max-width: 680px; position: relative; z-index: 1; }
        .apprentice-kicker { color: #b9a8df; font-size: .74rem; font-weight: 800; letter-spacing: .13em; }
        .apprentice-welcome h1 { font-size: clamp(1.9rem, 4.4vw, 3rem); font-weight: 850; margin: .75rem 0 .55rem; }
        .apprentice-welcome p { color: rgba(255,255,255,.8); font-size: 1.02rem; max-width: 540px; }
        .apprentice-primary-action { align-items: center; background: var(--apprentice-gold); border-radius: 10px; color: #32213e; display: inline-flex; font-weight: 800; gap: .7rem; margin-top: .55rem; padding: .75rem 1rem; text-decoration: none; }
        .apprentice-primary-action:hover { background: #ffc66b; color: #32213e; }
        .apprentice-welcome-art { align-items: center; color: #f8d18e; display: flex; font-size: clamp(5rem, 13vw, 9rem); justify-content: center; min-width: 210px; position: relative; }
        .apprentice-welcome-art > i { filter: drop-shadow(0 14px 18px rgba(15,10,25,.2)); position: relative; z-index: 1; }
        .apprentice-art-circle { border: 1px solid rgba(255,255,255,.2); border-radius: 50%; height: 190px; position: absolute; width: 190px; }
        .apprentice-art-circle-one { transform: scale(1.25); }
        .apprentice-art-circle-two { transform: scale(1.65); }
        .apprentice-course-callout { align-items: center; background: #fff8eb; border: 1px solid #f3dfbd; border-radius: 18px; display: flex; gap: 1rem; margin-bottom: 1.5rem; padding: 1.15rem 1.35rem; }
        .apprentice-course-symbol { align-items: center; background: #ffe8bd; border-radius: 14px; color: #8a5a17; display: inline-flex; flex: 0 0 52px; height: 52px; justify-content: center; }
        .apprentice-course-callout h2 { font-size: 1.2rem; font-weight: 800; margin: .25rem 0; }
        .apprentice-course-callout p { color: #766955; margin: 0; }
        .apprentice-course-callout .apprentice-kicker { color: #a56a1b; }
        .apprentice-course-callout > a { align-items: center; background: #efbd6b; border-radius: 50%; color: #4c351d; display: inline-flex; flex: 0 0 40px; height: 40px; justify-content: center; margin-left: auto; text-decoration: none; }
        .apprentice-community, .apprentice-latest { background: #fff; border: 1px solid #ebe6f2; border-radius: 19px; margin-bottom: 1.25rem; padding: clamp(1rem, 2.5vw, 1.5rem); }
        .apprentice-section-title { align-items: center; display: flex; justify-content: space-between; margin-bottom: 1rem; }
        .apprentice-section-title h2 { font-size: 1.3rem; font-weight: 800; margin: .25rem 0 0; }
        .apprentice-section-title .apprentice-kicker { color: var(--apprentice-purple); }
        .apprentice-section-title > i { color: #e4b85b; font-size: 1.5rem; }
        .apprentice-section-title > a { color: var(--apprentice-purple); font-size: .88rem; font-weight: 750; text-decoration: none; }
        .apprentice-community-grid { display: grid; gap: .9rem; grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .apprentice-community-card { align-items: center; border-radius: 14px; color: inherit; display: flex; gap: .85rem; min-width: 0; padding: 1rem; text-decoration: none; transition: transform .2s; }
        .apprentice-community-card:hover { color: inherit; transform: translateY(-3px); }
        .apprentice-news-card { background: #f1effb; }
        .apprentice-offers-card { background: #fdf2df; }
        .apprentice-community-icon { align-items: center; background: #e0daf4; border-radius: 12px; color: var(--apprentice-purple); display: inline-flex; flex: 0 0 44px; height: 44px; justify-content: center; }
        .apprentice-offers-card .apprentice-community-icon { background: #f9e3bb; color: #885e22; }
        .apprentice-community-copy { flex: 1; min-width: 0; }
        .apprentice-community-copy strong, .apprentice-community-copy small { display: block; }
        .apprentice-community-copy small { color: #6e6879; }
        .apprentice-card-arrow { color: var(--apprentice-purple); }
        .apprentice-course-card { align-items: center; border-top: 1px solid #f0edf4; color: inherit; display: flex; gap: .85rem; padding: .85rem .15rem; text-decoration: none; }
        .apprentice-course-card:hover { color: var(--apprentice-purple); }
        .apprentice-course-icon { align-items: center; background: #f1effb; border-radius: 11px; color: var(--apprentice-purple); display: inline-flex; flex: 0 0 40px; height: 40px; justify-content: center; }
        .apprentice-course-copy { flex: 1; min-width: 0; }
        .apprentice-course-copy strong, .apprentice-course-copy small { display: block; overflow: hidden; text-overflow: ellipsis; }
        .apprentice-course-copy small { color: #777181; }
        .apprentice-course-date { color: #777181; font-size: .82rem; white-space: nowrap; }
        .apprentice-course-card > .fa-chevron-right { color: #a59bb5; font-size: .8rem; }
        .apprentice-empty { color: #777181; padding: 1.5rem; text-align: center; }
        .apprentice-empty i { color: var(--apprentice-purple); font-size: 1.8rem; }
        @media (max-width: 700px) { .apprentice-welcome-art { display: none; } .apprentice-community-grid { grid-template-columns: 1fr; } .apprentice-course-date { display: none; } }
    </style>
@endsection
