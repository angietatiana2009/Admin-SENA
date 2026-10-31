@extends('layouts.app')

@section('Titulo', 'Notificaciones')

@section('contenido')
    <section class="notification-center" aria-labelledby="notifications-title">
        <header class="notification-heading">
            <div>
                <span class="notification-eyebrow">CENTRO DE ACTIVIDAD</span>
                <h1 id="notifications-title">Notificaciones</h1>
                <p>Revisa los registros recientes y las próximas fechas de formación.</p>
            </div>
            <span class="notification-today">
                <i class="far fa-calendar"></i> {{ now()->format('d/m/Y') }}
            </span>
        </header>

        <div class="notification-stats" aria-label="Resumen de registros">
            @foreach ($recordCounts as $label => $count)
                <div class="notification-stat">
                    <strong>{{ $count }}</strong>
                    <span>{{ $label }}</span>
                </div>
            @endforeach
        </div>

        <div class="notification-columns">
            <section class="notification-panel activity-panel" aria-labelledby="activity-title">
                <div class="panel-heading">
                    <div>
                        <span class="panel-eyebrow">HISTORIAL</span>
                        <h2 id="activity-title">Actividad reciente</h2>
                    </div>
                    <span class="panel-count">{{ $activities->count() }} registros</span>
                </div>

                @forelse ($activities as $activity)
                    <a class="activity-item" href="{{ $activity['url'] }}">
                        <span class="activity-icon {{ $activity['color'] }}">
                            <i class="fas {{ $activity['icon'] }}"></i>
                        </span>
                        <span class="activity-copy">
                            <strong>{{ $activity['title'] }}</strong>
                            <span>{{ $activity['description'] }}</span>
                            <small>{{ $activity['created_at']?->format('d/m/Y · H:i') ?? 'Fecha no disponible' }}</small>
                        </span>
                        <i class="fas fa-chevron-right activity-chevron" aria-hidden="true"></i>
                    </a>
                @empty
                    <div class="notification-empty">
                        <span class="empty-icon"><i class="far fa-bell-slash"></i></span>
                        <strong>Aún no hay actividad registrada</strong>
                        <p>Cuando se creen aprendices, cursos u otros registros, aparecerán aquí.</p>
                    </div>
                @endforelse
            </section>

            <aside class="notification-panel agenda-panel" aria-labelledby="agenda-title">
                <div class="panel-heading">
                    <div>
                        <span class="panel-eyebrow">PRÓXIMAS FECHAS</span>
                        <h2 id="agenda-title">Agenda de formación</h2>
                    </div>
                    <span class="agenda-heading-icon"><i class="far fa-calendar-check"></i></span>
                </div>

                @forelse ($upcomingCourses as $course)
                    <a class="agenda-item" href="{{ route('course.show', $course->id) }}">
                        <span class="agenda-date">
                            <strong>{{ \Illuminate\Support\Carbon::parse($course->day)->format('d') }}</strong>
                            <small>{{ \Illuminate\Support\Carbon::parse($course->day)->translatedFormat('M') }}</small>
                        </span>
                        <span class="agenda-copy">
                            <strong>Curso #{{ $course->numero_de_curso }}</strong>
                            <span>{{ $course->area?->name ?? 'Área por definir' }}</span>
                            <small>{{ \Illuminate\Support\Carbon::parse($course->day)->format('d/m/Y') }}</small>
                        </span>
                        <i class="fas fa-arrow-up-right-from-square agenda-link-icon" aria-hidden="true"></i>
                    </a>
                @empty
                    <div class="agenda-empty">
                        <i class="far fa-calendar"></i>
                        <strong>No hay cursos próximos</strong>
                        <p>Las fechas de inicio de los cursos aparecerán aquí.</p>
                    </div>
                @endforelse

                <a href="{{ route('course.index') }}" class="agenda-all-link">
                    Ver cursos <i class="fas fa-arrow-right"></i>
                </a>
            </aside>
        </div>
    </section>

    <style>
        .notification-center {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
        }

        .notification-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.1rem;
        }

        .notification-eyebrow,
        .panel-eyebrow {
            color: #287144;
            font-size: 0.67rem;
            font-weight: 800;
            letter-spacing: 0.09em;
        }

        .notification-heading h1 {
            margin: 0.15rem 0 0.2rem;
            color: #123b27;
            font-size: 1.55rem;
            font-weight: 750;
        }

        .notification-heading p {
            margin: 0;
            color: #718078;
            font-size: 0.88rem;
        }

        .notification-today {
            flex: 0 0 auto;
            padding: 0.5rem 0.7rem;
            border: 1px solid #e3ebe5;
            border-radius: 8px;
            background: #fff;
            color: #53665a;
            font-size: 0.78rem;
        }

        .notification-today i {
            margin-right: 0.25rem;
            color: #287144;
        }

        .notification-stats {
            display: grid;
            grid-template-columns: repeat(6, minmax(0, 1fr));
            gap: 0.7rem;
            margin-bottom: 1rem;
        }

        .notification-stat {
            display: flex;
            min-height: 66px;
            align-items: center;
            gap: 0.65rem;
            padding: 0.75rem 0.9rem;
            border: 1px solid #e8eee9;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 4px 12px rgba(15, 56, 35, .035);
        }

        .notification-stat strong {
            color: #176638;
            font-size: 1.35rem;
            line-height: 1;
        }

        .notification-stat span {
            color: #64736a;
            font-size: 0.74rem;
            font-weight: 600;
        }

        .notification-columns {
            display: grid;
            grid-template-columns: minmax(0, 1.55fr) minmax(280px, 0.9fr);
            align-items: start;
            gap: 1rem;
        }

        .notification-panel {
            min-width: 0;
            padding: 1rem;
            border: 1px solid #e7eee9;
            border-radius: 13px;
            background: #fff;
            box-shadow: 0 7px 20px rgba(15, 56, 35, .045);
        }

        .panel-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            margin-bottom: 0.6rem;
        }

        .panel-heading h2 {
            margin: 0.15rem 0 0;
            color: #173c29;
            font-size: 1.04rem;
            font-weight: 730;
        }

        .panel-count {
            color: #819087;
            font-size: 0.7rem;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 0.25rem;
            border-top: 1px solid #edf1ee;
            color: inherit;
            text-decoration: none;
        }

        .activity-item:hover,
        .agenda-item:hover {
            border-radius: 8px;
            background: #f7faf8;
            color: inherit;
        }

        .activity-icon {
            display: inline-flex;
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #eef5f0;
            font-size: 0.9rem;
        }

        .activity-copy,
        .agenda-copy {
            display: flex;
            min-width: 0;
            flex: 1;
            flex-direction: column;
            gap: 0.12rem;
        }

        .activity-copy strong,
        .agenda-copy strong {
            color: #263b2e;
            font-size: 0.8rem;
            font-weight: 680;
        }

        .activity-copy > span,
        .agenda-copy > span {
            overflow: hidden;
            color: #66756c;
            font-size: 0.75rem;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .activity-copy small,
        .agenda-copy small {
            color: #93a097;
            font-size: 0.67rem;
        }

        .activity-chevron {
            color: #9aaa9f;
            font-size: 0.68rem;
        }

        .notification-empty,
        .agenda-empty {
            display: flex;
            align-items: center;
            flex-direction: column;
            padding: 2rem 1rem;
            color: #708077;
            text-align: center;
        }

        .notification-empty .empty-icon {
            display: inline-flex;
            width: 48px;
            height: 48px;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.65rem;
            border-radius: 50%;
            background: #edf5ef;
            color: #4b8960;
            font-size: 1.15rem;
        }

        .notification-empty strong,
        .agenda-empty strong {
            color: #34513e;
            font-size: 0.83rem;
        }

        .notification-empty p,
        .agenda-empty p {
            max-width: 300px;
            margin: 0.3rem 0 0;
            font-size: 0.75rem;
        }

        .agenda-heading-icon {
            color: #368451;
            font-size: 1.1rem;
        }

        .agenda-item {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.75rem 0.2rem;
            border-top: 1px solid #edf1ee;
            color: inherit;
            text-decoration: none;
        }

        .agenda-date {
            display: flex;
            width: 43px;
            height: 48px;
            flex: 0 0 43px;
            align-items: center;
            flex-direction: column;
            justify-content: center;
            border-radius: 8px;
            background: #edf6ef;
            color: #287144;
        }

        .agenda-date strong {
            font-size: 1rem;
            line-height: 1;
        }

        .agenda-date small {
            margin-top: 0.1rem;
            font-size: 0.62rem;
            text-transform: uppercase;
        }

        .agenda-link-icon {
            color: #9aaa9f;
            font-size: 0.65rem;
        }

        .agenda-empty {
            padding: 2rem 0.75rem;
        }

        .agenda-empty > i {
            margin-bottom: 0.65rem;
            color: #4b8960;
            font-size: 1.4rem;
        }

        .agenda-all-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 0.35rem;
            padding: 0.7rem 0.2rem 0.1rem;
            border-top: 1px solid #edf1ee;
            color: #287144;
            font-size: 0.78rem;
            font-weight: 700;
            text-decoration: none;
        }

        .agenda-all-link:hover {
            color: #15552c;
        }

        @media (max-width: 1000px) {
            .notification-stats {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .notification-columns {
                grid-template-columns: minmax(0, 1.3fr) minmax(250px, 1fr);
            }
        }

        @media (max-width: 720px) {
            .notification-columns {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .notification-heading {
                align-items: start;
                flex-direction: column;
            }

            .notification-stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 0.5rem;
            }

            .notification-stat {
                min-height: 56px;
                padding: 0.6rem;
            }

            .notification-panel {
                padding: 0.75rem;
            }
        }
    </style>
@endsection
