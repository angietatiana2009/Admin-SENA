@extends('layouts.app')

@section('Titulo', 'Gestión de cursos')

@section('contenido')
    @php
        $readOnlyRole = auth()->check() && in_array(auth()->user()->role, ['teacher', 'apprentice'], true);
        $parseCourseDate = static function ($day) {
            return $day && strtotime($day) !== false
                ? \Illuminate\Support\Carbon::parse($day)
                : null;
        };
        $upcomingCourses = $courses->filter(function ($course) use ($parseCourseDate) {
            $date = $parseCourseDate($course->day);

            return $date && $date->isFuture();
        })->count();
        $withArea = $courses->filter(fn ($course) => $course->area)->count();
        $withCenter = $courses->filter(fn ($course) => $course->training_center)->count();
    @endphp

    <section class="courses-page" aria-labelledby="courses-title">
        <header class="courses-hero">
            <div class="courses-hero-copy">
                <span class="courses-eyebrow">FORMACIÓN SENA</span>
                <h1 id="courses-title">Gestión de cursos</h1>
                <p>Consulta la programación, las áreas y los centros asociados a cada curso.</p>
            </div>
            @unless ($readOnlyRole)
                <a href="{{ route('course.registro') }}" class="btn courses-create-btn">
                    <i class="fas fa-plus"></i> Registrar curso
                </a>
            @endunless
            <span class="courses-hero-mark" aria-hidden="true"><i class="fas fa-book-open"></i></span>
        </header>

        <div class="courses-summary" aria-label="Resumen de cursos">
            <article class="course-summary-card">
                <span class="summary-icon summary-icon-green"><i class="fas fa-book"></i></span>
                <span><strong>{{ $courses->count() }}</strong><small>Total de cursos</small></span>
            </article>
            <article class="course-summary-card">
                <span class="summary-icon summary-icon-blue"><i class="far fa-calendar-check"></i></span>
                <span><strong>{{ $upcomingCourses }}</strong><small>Próximos a iniciar</small></span>
            </article>
            <article class="course-summary-card">
                <span class="summary-icon summary-icon-purple"><i class="fas fa-layer-group"></i></span>
                <span><strong>{{ $withArea }}</strong><small>Con área asignada</small></span>
            </article>
            <article class="course-summary-card">
                <span class="summary-icon summary-icon-orange"><i class="fas fa-building"></i></span>
                <span><strong>{{ $withCenter }}</strong><small>Con centro asignado</small></span>
            </article>
        </div>

        <section class="courses-list-card" aria-labelledby="courses-list-title">
            <div class="courses-list-heading">
                <div>
                    <span class="list-eyebrow">DIRECTORIO ACADÉMICO</span>
                    <h2 id="courses-list-title">Cursos registrados</h2>
                    <p>Gestiona la información y consulta el detalle de cada curso.</p>
                </div>
                <label class="courses-search" for="courseSearch">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input type="search" id="courseSearch" placeholder="Buscar curso, área o centro..." autocomplete="off">
                </label>
            </div>

            <div class="table-responsive">
                <table class="table courses-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Curso</th>
                            <th scope="col">Fecha de inicio</th>
                            <th scope="col">Área</th>
                            <th scope="col">Centro de formación</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="coursesTableBody">
                        @forelse ($courses as $course)
                            <tr class="course-row">
                                <td data-label="Curso">
                                    <a class="course-number" href="{{ route('course.show', $course->id) }}">
                                        <span class="course-row-icon"><i class="fas fa-book-open"></i></span>
                                        <span>
                                            <strong>Curso #{{ $course->numero_de_curso }}</strong>
                                            <small>Registro académico</small>
                                        </span>
                                    </a>
                                </td>
                                <td data-label="Fecha de inicio">
                                    @if ($course->day)
                                        @php($courseDate = $parseCourseDate($course->day))
                                        @if ($courseDate)
                                            <span class="course-date">
                                                <i class="far fa-calendar"></i>
                                                {{ $courseDate->format('d/m/Y') }}
                                            </span>
                                        @else
                                            <span class="course-muted">{{ $course->day }}</span>
                                        @endif
                                    @else
                                        <span class="course-muted">Sin fecha</span>
                                    @endif
                                </td>
                                <td data-label="Área">
                                    @if ($course->area)
                                        <span class="course-tag"><i class="fas fa-layer-group"></i>{{ $course->area->name }}</span>
                                    @else
                                        <span class="course-muted">Por asignar</span>
                                    @endif
                                </td>
                                <td data-label="Centro de formación">
                                    @if ($course->training_center)
                                        <span class="course-center">
                                            <i class="fas fa-location-dot"></i>
                                            <span>
                                                <strong>{{ $course->training_center->name }}</strong>
                                                <small>{{ $course->training_center->location }}</small>
                                            </span>
                                        </span>
                                    @else
                                        <span class="course-muted">Por asignar</span>
                                    @endif
                                </td>
                                <td data-label="Acciones" class="text-end">
                                    <div class="course-actions">
                                        <a href="{{ route('course.show', $course->id) }}" class="course-action-btn" title="Ver curso" aria-label="Ver curso">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @unless ($readOnlyRole)
                                            <a href="{{ route('course.edit', $course->id) }}" class="course-action-btn" title="Editar curso" aria-label="Editar curso">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <form action="{{ route('course.destroy', $course->id) }}" method="POST" onsubmit="return confirm('¿Deseas eliminar el curso #{{ $course->numero_de_curso }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="course-action-btn course-delete-btn" title="Eliminar curso" aria-label="Eliminar curso">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endunless
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr id="coursesEmptyRow">
                                <td colspan="5">
                                    <div class="courses-empty-state">
                                        <span class="empty-state-icon"><i class="fas fa-book-open"></i></span>
                                        <strong>Aún no hay cursos registrados</strong>
                                        <p>Registra el primer curso para empezar a organizar la oferta de formación.</p>
                                        @unless ($readOnlyRole)
                                            <a href="{{ route('course.registro') }}" class="btn courses-empty-btn">
                                                <i class="fas fa-plus"></i> Registrar primer curso
                                            </a>
                                        @endunless
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        <tr id="coursesNoResults" class="d-none">
                            <td colspan="5" class="text-center text-muted py-4">No hay cursos que coincidan con la búsqueda.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <footer class="courses-list-footer">
                <span><i class="fas fa-circle-info"></i> Se muestran {{ $courses->count() }} cursos registrados</span>
                @unless ($readOnlyRole)
                    <a href="{{ route('course.registro') }}">Añadir un curso <i class="fas fa-arrow-right"></i></a>
                @endunless
            </footer>
        </section>
    </section>

    <style>
        .courses-page {
            width: 100%;
            max-width: 1320px;
            margin: 0 auto;
        }

        .courses-hero {
            position: relative;
            display: flex;
            min-height: 164px;
            align-items: center;
            justify-content: space-between;
            gap: 1.25rem;
            overflow: hidden;
            margin-bottom: 1rem;
            padding: 1.6rem 1.8rem;
            border-radius: 14px;
            background: linear-gradient(115deg, #0f3823 0%, #155b36 66%, #247a43 100%);
            box-shadow: 0 10px 24px rgba(15, 56, 35, .12);
            color: #fff;
        }

        .courses-hero-copy {
            position: relative;
            z-index: 1;
        }

        .courses-eyebrow,
        .list-eyebrow {
            color: #a7e887;
            font-size: 0.66rem;
            font-weight: 800;
            letter-spacing: .1em;
        }

        .courses-hero h1 {
            margin: 0.35rem 0 0.3rem;
            color: #fff;
            font-size: clamp(1.45rem, 2.4vw, 2rem);
            font-weight: 750;
        }

        .courses-hero p {
            margin: 0;
            color: rgba(255, 255, 255, .8);
            font-size: 0.84rem;
        }

        .courses-create-btn,
        .courses-empty-btn {
            position: relative;
            z-index: 1;
            display: inline-flex;
            min-height: 40px;
            align-items: center;
            gap: 0.5rem;
            padding: 0.55rem 0.9rem;
            border: 1px solid rgba(255, 255, 255, .34);
            border-radius: 8px;
            background: #39a900;
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .courses-create-btn:hover,
        .courses-empty-btn:hover {
            background: #2d8e00;
            color: #fff;
        }

        .courses-hero-mark {
            position: absolute;
            right: 10rem;
            color: rgba(255, 255, 255, .055);
            font-size: 8rem;
            transform: rotate(-12deg);
        }

        .courses-summary {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .course-summary-card {
            display: flex;
            min-height: 76px;
            align-items: center;
            gap: 0.7rem;
            padding: 0.8rem 0.9rem;
            border: 1px solid #e7eee9;
            border-radius: 11px;
            background: #fff;
            box-shadow: 0 4px 12px rgba(15, 56, 35, .035);
        }

        .summary-icon {
            display: inline-flex;
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 0.92rem;
        }

        .summary-icon-green { background: #e8f5eb; color: #278246; }
        .summary-icon-blue { background: #eaf3fb; color: #398cc7; }
        .summary-icon-purple { background: #f0edfa; color: #8064bd; }
        .summary-icon-orange { background: #fff3e5; color: #d88a27; }

        .course-summary-card > span:last-child {
            display: flex;
            flex-direction: column;
            gap: 0.1rem;
        }

        .course-summary-card strong {
            color: #173c29;
            font-size: 1.15rem;
            line-height: 1.1;
        }

        .course-summary-card small {
            color: #78877e;
            font-size: 0.7rem;
        }

        .courses-list-card {
            overflow: hidden;
            border: 1px solid #e7eee9;
            border-radius: 13px;
            background: #fff;
            box-shadow: 0 7px 20px rgba(15, 56, 35, .045);
        }

        .courses-list-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 1.1rem 1.2rem;
        }

        .list-eyebrow {
            color: #368451;
            font-size: 0.62rem;
        }

        .courses-list-heading h2 {
            margin: 0.2rem 0 0.15rem;
            color: #173c29;
            font-size: 1.05rem;
            font-weight: 730;
        }

        .courses-list-heading p {
            margin: 0;
            color: #819087;
            font-size: 0.74rem;
        }

        .courses-search {
            display: flex;
            width: min(320px, 42%);
            min-height: 38px;
            align-items: center;
            gap: 0.5rem;
            padding: 0 0.7rem;
            border: 1px solid #dfe8e1;
            border-radius: 8px;
            color: #6e9a7b;
        }

        .courses-search:focus-within {
            border-color: #68a87a;
            box-shadow: 0 0 0 3px rgba(57, 169, 0, .1);
        }

        .courses-search input {
            width: 100%;
            min-width: 0;
            border: 0;
            outline: 0;
            background: transparent;
            color: #263b2e;
            font-size: 0.74rem;
        }

        .courses-search input::placeholder {
            color: #98a49d;
        }

        .courses-table {
            min-width: 700px;
            border-top: 1px solid #edf1ee;
        }

        .courses-table thead th {
            padding: 0.72rem 1rem;
            border-bottom: 1px solid #e7eee9;
            background: #f6f9f7;
            color: #65756a;
            font-size: 0.66rem;
            font-weight: 750;
            letter-spacing: .025em;
            white-space: nowrap;
        }

        .courses-table tbody td {
            padding: 0.8rem 1rem;
            border-color: #edf1ee;
            color: #526258;
            font-size: 0.75rem;
        }

        .courses-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .course-number,
        .course-center {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
        }

        .course-number {
            color: inherit;
            text-decoration: none;
        }

        .course-number:hover strong {
            color: #247342;
        }

        .course-row-icon {
            display: inline-flex;
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: #e9f4ec;
            color: #34804d;
        }

        .course-number > span:last-child,
        .course-center > span {
            display: flex;
            flex-direction: column;
            gap: 0.12rem;
        }

        .course-number strong,
        .course-center strong {
            color: #263b2e;
            font-size: 0.76rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .course-number small,
        .course-center small {
            color: #8a978f;
            font-size: 0.65rem;
        }

        .course-date {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            white-space: nowrap;
        }

        .course-date i,
        .course-center > i {
            color: #54966a;
        }

        .course-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            max-width: 180px;
            padding: 0.28rem 0.5rem;
            overflow: hidden;
            border-radius: 20px;
            background: #f1f7f2;
            color: #497356;
            font-size: 0.68rem;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .course-muted {
            color: #99a49d;
            font-size: 0.72rem;
        }

        .course-actions {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        .course-actions form {
            display: inline-flex;
            margin: 0;
        }

        .course-action-btn {
            display: inline-flex;
            width: 30px;
            height: 30px;
            align-items: center;
            justify-content: center;
            border: 1px solid #e1e9e3;
            border-radius: 7px;
            background: #fff;
            color: #52745d;
            font-size: 0.7rem;
            text-decoration: none;
            transition: background .15s ease, color .15s ease, border-color .15s ease;
        }

        .course-action-btn:hover {
            border-color: #b9d6c0;
            background: #eff7f1;
            color: #1f6a39;
        }

        .course-delete-btn:hover {
            border-color: #f0c3c3;
            background: #fff3f3;
            color: #bd3d3d;
        }

        .courses-empty-state {
            display: flex;
            min-height: 230px;
            align-items: center;
            flex-direction: column;
            justify-content: center;
            padding: 1.5rem;
            text-align: center;
        }

        .empty-state-icon {
            display: inline-flex;
            width: 52px;
            height: 52px;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.65rem;
            border-radius: 50%;
            background: #eaf5ec;
            color: #398653;
            font-size: 1.15rem;
        }

        .courses-empty-state strong {
            color: #274331;
            font-size: 0.9rem;
        }

        .courses-empty-state p {
            margin: 0.25rem 0 0.85rem;
            color: #829087;
            font-size: 0.75rem;
        }

        .courses-empty-btn {
            min-height: 35px;
            border: 0;
            font-size: 0.74rem;
        }

        .courses-list-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            padding: 0.7rem 1.2rem;
            border-top: 1px solid #edf1ee;
            color: #86938b;
            font-size: 0.68rem;
        }

        .courses-list-footer span i {
            margin-right: 0.25rem;
            color: #5b9a6d;
        }

        .courses-list-footer a {
            color: #287144;
            font-weight: 700;
            text-decoration: none;
        }

        .courses-list-footer a i {
            margin-left: 0.2rem;
        }

        @media (max-width: 900px) {
            .courses-summary {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 600px) {
            .courses-hero {
                min-height: 0;
                align-items: flex-start;
                flex-direction: column;
                padding: 1.2rem;
            }

            .courses-hero-mark {
                right: 1rem;
                bottom: -1.2rem;
                font-size: 6rem;
            }

            .courses-list-heading {
                align-items: stretch;
                flex-direction: column;
                padding: 0.9rem;
            }

            .courses-search {
                width: 100%;
            }

            .courses-list-footer {
                align-items: flex-start;
                flex-direction: column;
                padding: 0.7rem 0.9rem;
            }
        }

        @media (max-width: 380px) {
            .courses-summary {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <script>
        const courseSearch = document.getElementById('courseSearch');
        const courseRows = Array.from(document.querySelectorAll('.course-row'));
        const noResultsRow = document.getElementById('coursesNoResults');

        if (courseSearch && noResultsRow) {
            courseSearch.addEventListener('input', function () {
                const query = this.value.trim().toLocaleLowerCase();
                let visibleRows = 0;

                courseRows.forEach(function (row) {
                    const matches = row.textContent.toLocaleLowerCase().includes(query);
                    row.classList.toggle('d-none', !matches);
                    if (matches) visibleRows++;
                });

                noResultsRow.classList.toggle('d-none', visibleRows !== 0 || courseRows.length === 0);
            });
        }
    </script>
@endsection
