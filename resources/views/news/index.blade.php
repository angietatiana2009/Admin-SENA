@extends('layouts.app')

@section('Titulo', 'Noticias')

@section('contenido')
    @php
        $news = [
            [
                'date' => '28 de agosto de 2026',
                'date_iso' => '2026-08-28',
                'category' => 'Formación',
                'title' => 'Nuevas oportunidades de formación para la comunidad',
                'summary' => 'Conoce los programas disponibles y prepárate para iniciar una nueva etapa de aprendizaje.',
                'details' => 'Consulta la oferta de formación disponible en tu centro y revisa los requisitos, horarios y fechas de inscripción antes de postularte.',
                'icon' => 'fa-book-open-reader',
                'tone' => 'green',
            ],
            [
                'date' => '21 de agosto de 2026',
                'date_iso' => '2026-08-21',
                'category' => 'Comunidad',
                'title' => 'El talento de nuestros aprendices sigue creciendo',
                'summary' => 'Historias y proyectos que muestran el impacto de la formación SENA en las regiones.',
                'details' => 'La comunidad comparte iniciativas que aplican lo aprendido para responder a necesidades reales de sus territorios y fortalecer el trabajo colaborativo.',
                'icon' => 'fa-users',
                'tone' => 'blue',
            ],
            [
                'date' => '14 de agosto de 2026',
                'date_iso' => '2026-08-14',
                'category' => 'Institucional',
                'title' => 'Agenda de actividades del centro de formación',
                'summary' => 'Revisa las actividades académicas, encuentros y espacios de participación programados.',
                'details' => 'Organiza tu participación consultando con tu centro los horarios y espacios asignados para las actividades académicas y comunitarias.',
                'icon' => 'fa-calendar-days',
                'tone' => 'amber',
            ],
        ];

        $categories = collect($news)->pluck('category')->unique()->values();
    @endphp

    <style>
        .news-page {
            --news-green: #0d4f2f;
            --news-light: #eaf5ee;
            color: #24352b;
        }

        .news-hero {
            align-items: center;
            background:
                radial-gradient(circle at 88% 20%, rgba(116, 200, 74, .2), transparent 24%),
                linear-gradient(115deg, #103b28 0%, #145735 65%, #1b7040 100%);
            border: 1px solid rgba(255, 255, 255, .08);
            border-radius: 16px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            margin-bottom: 1.25rem;
            min-height: 148px;
            overflow: hidden;
            padding: 1.5rem 1.75rem;
            position: relative;
        }

        .news-hero::after {
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 50%;
            content: "";
            height: 210px;
            position: absolute;
            right: 7%;
            top: -95px;
            width: 210px;
        }

        .news-hero-copy { max-width: 590px; position: relative; z-index: 1; }

        .news-kicker {
            color: #b9e6a6;
            font-size: .7rem;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .news-hero h1 {
            font-size: clamp(1.45rem, 2.5vw, 2rem);
            letter-spacing: -.025em;
        }

        .news-hero p { color: rgba(255, 255, 255, .78); }

        .news-hero-mark {
            align-items: center;
            background: rgba(255, 255, 255, .09);
            border: 1px solid rgba(255, 255, 255, .15);
            border-radius: 18px;
            color: #d8f0d0;
            display: flex;
            font-size: 1.8rem;
            height: 76px;
            justify-content: center;
            margin-right: 2.5rem;
            position: relative;
            width: 76px;
            z-index: 1;
        }

        .news-count {
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 999px;
            color: #fff;
            display: inline-block;
            font-size: .78rem;
            font-weight: 600;
            margin-top: .35rem;
            padding: .35rem .7rem;
        }

        .news-toolbar {
            border: 1px solid #e5ebe7;
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 3px 12px rgba(22, 52, 35, .035);
            padding: .85rem 1rem;
        }

        .news-search {
            position: relative;
        }

        .news-search i {
            color: #6b8a77;
            left: 14px;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .news-search input {
            border-radius: 10px;
            padding-left: 2.5rem;
        }

        .news-filter {
            background: #f5f8f6;
            border: 1px solid transparent;
            border-radius: 999px;
            color: #52635a;
            font-size: .85rem;
            font-weight: 600;
            padding: .45rem .8rem;
            transition: background-color .18s ease, color .18s ease, border-color .18s ease;
        }

        .news-filter:hover,
        .news-filter.is-active {
            background: var(--news-light);
            border-color: #cce4d4;
            color: var(--news-green);
        }

        .news-card {
            border: 1px solid #e6ece8;
            border-radius: 14px;
            box-shadow: 0 4px 14px rgba(22, 52, 35, .045);
            min-height: 245px;
            transition: border-color .18s ease, box-shadow .18s ease, transform .18s ease;
        }

        .news-card:hover {
            border-color: #c8dfd0;
            box-shadow: 0 10px 22px rgba(22, 52, 35, .09);
            transform: translateY(-2px);
        }

        .news-icon {
            align-items: center;
            border-radius: 11px;
            display: inline-flex;
            flex: 0 0 42px;
            height: 42px;
            justify-content: center;
            width: 42px;
        }

        .news-icon--green { background: #eaf5ee; color: #27824a; }
        .news-icon--blue { background: #edf3fb; color: #4778b8; }
        .news-icon--amber { background: #fff4e7; color: #c27b24; }

        .news-card h2 {
            color: var(--news-green);
            font-size: 1.05rem;
            line-height: 1.4;
        }

        .news-item:last-child:nth-child(odd) {
            margin-left: auto;
            margin-right: auto;
        }

        .news-category {
            background: #edf6f0;
            border-radius: 999px;
            color: #287348;
            font-size: .72rem;
            font-weight: 700;
            padding: .3rem .6rem;
        }

        .news-read {
            color: #237344;
            font-size: .88rem;
            font-weight: 700;
            text-decoration: none;
        }

        .news-read:hover { color: #14552f; }

        .news-details {
            border-top: 1px solid #edf1ee;
            margin-top: 1rem;
            padding-top: 1rem;
        }

        .news-empty {
            border: 1px dashed #cbd8cf;
            border-radius: 14px;
            color: #65746b;
            padding: 2rem 1rem;
            text-align: center;
        }

        @media (prefers-reduced-motion: reduce) {
            .news-card,
            .news-filter { transition: none; }
        }

        @media (max-width: 575.98px) {
            .news-hero {
                min-height: 0;
                padding: 1.25rem;
            }

            .news-hero-mark { display: none; }
            .news-card { min-height: 0; }
        }
    </style>

    <main class="news-page">
        <header class="news-hero">
            <div class="news-hero-copy">
                <span class="news-kicker">Comunidad SENA · Actualidad</span>
                <h1 class="fw-bold mb-1 mt-2">Noticias y novedades</h1>
                <p class="mb-1">Ideas, logros y actividades que conectan a nuestra comunidad.</p>
                <span class="news-count">
                    <i class="fas fa-newspaper me-1" aria-hidden="true"></i>
                    <span id="news-count">{{ count($news) }}</span> publicaciones
                </span>
            </div>
            <span class="news-hero-mark" aria-hidden="true"><i class="fas fa-newspaper"></i></span>
        </header>

        <section class="news-toolbar mb-4" aria-label="Buscar y filtrar noticias">
            <div class="align-items-center d-flex flex-column flex-lg-row gap-3 justify-content-between">
                <div class="news-search w-100" style="max-width: 340px;">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input class="form-control" id="news-search" type="search" placeholder="Buscar noticias..." aria-label="Buscar noticias">
                </div>
                <div class="d-flex flex-wrap gap-2" role="group" aria-label="Filtrar por categoría">
                    <button class="news-filter is-active" type="button" data-news-filter="all" aria-pressed="true">Todas</button>
                    @foreach ($categories as $category)
                        <button class="news-filter" type="button" data-news-filter="{{ $category }}" aria-pressed="false">{{ $category }}</button>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="row g-3" id="news-list" aria-label="Listado de noticias">
            @foreach ($news as $index => $item)
                <div class="col-lg-4 col-md-6 news-item"
                    data-category="{{ $item['category'] }}"
                    data-search="{{ \Illuminate\Support\Str::lower($item['title'].' '.$item['summary'].' '.$item['category']) }}">
                    <article class="card news-card h-100">
                        <div class="card-body d-flex flex-column p-3 p-md-4">
                            <div class="align-items-center d-flex gap-3 mb-3">
                                <span class="news-icon news-icon--{{ $item['tone'] }}">
                                    <i class="fas {{ $item['icon'] }}" aria-hidden="true"></i>
                                </span>
                                <div class="d-flex flex-column gap-1">
                                    <span class="news-category align-self-start">{{ $item['category'] }}</span>
                                    <time class="small text-muted" datetime="{{ $item['date_iso'] }}">{{ $item['date'] }}</time>
                                </div>
                            </div>

                            <h2 class="fw-bold mb-2">{{ $item['title'] }}</h2>
                            <p class="mb-0 text-muted">{{ $item['summary'] }}</p>

                            <div class="news-details d-none" id="news-details-{{ $index }}">
                                <p class="mb-0 small text-secondary">{{ $item['details'] }}</p>
                            </div>

                            <button class="btn btn-link align-self-start mt-auto news-read p-0 pt-3"
                                type="button"
                                data-news-toggle="news-details-{{ $index }}"
                                aria-expanded="false"
                                aria-controls="news-details-{{ $index }}">
                                Leer noticia <i class="fas fa-arrow-right ms-1" aria-hidden="true"></i>
                            </button>
                        </div>
                    </article>
                </div>
            @endforeach
        </section>

        <div class="d-none mt-3 news-empty" id="news-empty" role="status">
            <i class="fas fa-magnifying-glass mb-2" aria-hidden="true"></i>
            <p class="mb-0">No encontramos noticias con esos criterios. Prueba otra búsqueda o categoría.</p>
        </div>
    </main>

    <script>
        (function () {
            const searchInput = document.getElementById('news-search');
            const filterButtons = document.querySelectorAll('[data-news-filter]');
            const items = Array.from(document.querySelectorAll('.news-item'));
            const count = document.getElementById('news-count');
            const emptyState = document.getElementById('news-empty');
            let activeCategory = 'all';

            function normalize(value) {
                return value.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
            }

            function updateNews() {
                const term = normalize(searchInput.value.trim());
                let visibleCount = 0;

                items.forEach(function (item) {
                    const matchesCategory = activeCategory === 'all' || item.dataset.category === activeCategory;
                    const matchesSearch = normalize(item.dataset.search).includes(term);
                    const isVisible = matchesCategory && matchesSearch;

                    item.classList.toggle('d-none', !isVisible);
                    if (!isVisible) {
                        const details = item.querySelector('.news-details');
                        const toggle = item.querySelector('[data-news-toggle]');
                        details.classList.add('d-none');
                        toggle.setAttribute('aria-expanded', 'false');
                        toggle.innerHTML = 'Leer noticia <i class="fas fa-arrow-right ms-1" aria-hidden="true"></i>';
                    } else {
                        visibleCount += 1;
                    }
                });

                count.textContent = visibleCount;
                emptyState.classList.toggle('d-none', visibleCount > 0);
            }

            searchInput.addEventListener('input', updateNews);

            filterButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    activeCategory = button.dataset.newsFilter;
                    filterButtons.forEach(function (filter) {
                        const isActive = filter === button;
                        filter.classList.toggle('is-active', isActive);
                        filter.setAttribute('aria-pressed', String(isActive));
                    });
                    updateNews();
                });
            });

            document.querySelectorAll('[data-news-toggle]').forEach(function (button) {
                button.addEventListener('click', function () {
                    const details = document.getElementById(button.dataset.newsToggle);
                    const isExpanded = button.getAttribute('aria-expanded') === 'true';
                    details.classList.toggle('d-none', isExpanded);
                    button.setAttribute('aria-expanded', String(!isExpanded));
                    button.innerHTML = isExpanded
                        ? 'Leer noticia <i class="fas fa-arrow-right ms-1" aria-hidden="true"></i>'
                        : 'Cerrar noticia <i class="fas fa-arrow-up ms-1" aria-hidden="true"></i>';
                });
            });
        })();
    </script>
@endsection
