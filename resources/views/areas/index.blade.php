@extends('layouts.app')

@section('Titulo', 'Áreas de formación')

@section('contenido')
    @php($readOnlyRole = auth()->check() && in_array(auth()->user()->role, ['teacher', 'apprentice'], true))

    <section class="areas-page" aria-labelledby="areas-title">
        <header class="areas-hero">
            <div class="areas-hero-copy">
                <span class="areas-eyebrow">ORGANIZACIÓN ACADÉMICA</span>
                <h1 id="areas-title">Áreas de formación</h1>
                <p>Explora las áreas que organizan los programas y cursos de formación.</p>
            </div>
            @unless ($readOnlyRole)
                <a href="{{ route('area.create') }}" class="areas-create-btn">
                    <i class="fas fa-plus"></i> Nueva área
                </a>
            @endunless
            <span class="areas-hero-mark" aria-hidden="true"><i class="fas fa-layer-group"></i></span>
        </header>

        <div class="areas-summary">
            <span class="areas-summary-icon"><i class="fas fa-layer-group"></i></span>
            <span>
                <strong>{{ $areas->count() }}</strong>
                <small>{{ $areas->count() === 1 ? 'Área registrada' : 'Áreas registradas' }}</small>
            </span>
        </div>

        <section class="areas-list-card" aria-labelledby="areas-list-title">
            <div class="areas-list-heading">
                <div>
                    <span class="areas-list-eyebrow">DIRECTORIO</span>
                    <h2 id="areas-list-title">Listado de áreas</h2>
                    <p>Consulta las áreas disponibles en el sistema.</p>
                </div>
                @if ($areas->isNotEmpty())
                    <label class="areas-search" for="areaSearch">
                        <i class="fas fa-search" aria-hidden="true"></i>
                        <input type="search" id="areaSearch" placeholder="Buscar área..." autocomplete="off">
                    </label>
                @endif
            </div>

            <div class="table-responsive">
                <table class="table areas-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="areas-number-heading">#</th>
                            <th scope="col">Nombre del área</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="areasTableBody">
                        @forelse ($areas as $area)
                            <tr class="area-row">
                                <td class="areas-number">{{ $loop->iteration }}</td>
                                <td>
                                    <span class="area-name">
                                        <span class="area-row-icon"><i class="fas fa-layer-group"></i></span>
                                        <strong>{{ $area->name }}</strong>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="area-actions">
                                        <a href="{{ route('area.show', $area->id) }}" class="area-action-btn area-view-btn" aria-label="Ver {{ $area->name }}" title="Ver área">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @unless ($readOnlyRole)
                                            <a href="{{ route('area.edit', $area->id) }}" class="area-action-btn area-edit-btn" aria-label="Editar {{ $area->name }}" title="Editar área">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <form action="{{ route('area.destroy', $area->id) }}" method="POST" onsubmit="return confirm('¿Deseas eliminar el área {{ $area->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="area-action-btn area-delete-btn" aria-label="Eliminar {{ $area->name }}" title="Eliminar área">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endunless
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">
                                    <div class="areas-empty">
                                        <span class="areas-empty-icon"><i class="fas fa-layer-group"></i></span>
                                        <strong>Aún no hay áreas registradas</strong>
                                        <p>Cuando se agreguen, aparecerán aquí.</p>
                                        @unless ($readOnlyRole)
                                            <a href="{{ route('area.create') }}" class="areas-create-btn">
                                                <i class="fas fa-plus"></i> Registrar primera área
                                            </a>
                                        @endunless
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        @if ($areas->isNotEmpty())
                            <tr id="areasNoResults" class="d-none">
                                <td colspan="3" class="text-center text-muted py-4">No se encontraron áreas con ese nombre.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            @if ($areas->isNotEmpty())
                <footer class="areas-list-footer">
                    <span><i class="fas fa-circle-info"></i> Total: {{ $areas->count() }} {{ $areas->count() === 1 ? 'área' : 'áreas' }}</span>
                </footer>
            @endif
        </section>
    </section>

    <style>
        .areas-page { --areas-green: #0d4f2f; --areas-accent: #39a900; --areas-ink: #26372e; color: var(--areas-ink); margin: 0 auto; max-width: 1320px; }
        .areas-hero { align-items: center; background: linear-gradient(120deg, #0d4f2f, #17683b 68%, #39a900); border-radius: 18px; color: #fff; display: flex; justify-content: space-between; margin-bottom: 1rem; min-height: 160px; overflow: hidden; padding: clamp(1.4rem, 3vw, 2.3rem); position: relative; }
        .areas-hero-copy { position: relative; z-index: 1; }
        .areas-eyebrow, .areas-list-eyebrow { color: #c5e8ce; font-size: .73rem; font-weight: 800; letter-spacing: .12em; }
        .areas-hero h1 { font-size: clamp(1.7rem, 3vw, 2.35rem); font-weight: 800; margin: .45rem 0; }
        .areas-hero p { color: rgba(255,255,255,.82); margin: 0; max-width: 600px; }
        .areas-hero-mark { color: rgba(255,255,255,.15); font-size: clamp(4rem, 9vw, 7rem); margin: 0 1.5rem; }
        .areas-create-btn { align-items: center; background: #fff; border: 0; border-radius: 9px; color: var(--areas-green); display: inline-flex; font-size: .9rem; font-weight: 750; gap: .5rem; padding: .7rem 1rem; position: relative; text-decoration: none; transition: transform .18s, box-shadow .18s; white-space: nowrap; z-index: 1; }
        .areas-create-btn:hover { box-shadow: 0 8px 18px rgba(0,0,0,.16); color: var(--areas-green); transform: translateY(-2px); }
        .areas-summary { align-items: center; background: #fff; border: 1px solid #e3ece5; border-radius: 13px; box-shadow: 0 5px 16px rgba(16,55,31,.04); display: inline-flex; gap: .8rem; margin-bottom: 1rem; min-width: 190px; padding: .8rem 1rem; }
        .areas-summary-icon { align-items: center; background: #e8f5e9; border-radius: 10px; color: var(--areas-green); display: inline-flex; height: 42px; justify-content: center; width: 42px; }
        .areas-summary strong, .areas-summary small { display: block; }
        .areas-summary strong { font-size: 1.3rem; line-height: 1.1; }
        .areas-summary small { color: #708076; font-size: .78rem; }
        .areas-list-card { background: #fff; border: 1px solid #e3ece5; border-radius: 16px; box-shadow: 0 8px 24px rgba(16,55,31,.05); overflow: hidden; }
        .areas-list-heading { align-items: center; display: flex; gap: 1rem; justify-content: space-between; padding: 1.25rem 1.4rem; }
        .areas-list-eyebrow { color: #388044; }
        .areas-list-heading h2 { color: #173d27; font-size: 1.25rem; font-weight: 800; margin: .25rem 0; }
        .areas-list-heading p { color: #718078; font-size: .9rem; margin: 0; }
        .areas-search { align-items: center; background: #f8faf8; border: 1px solid #dce7de; border-radius: 9px; color: #62806a; display: flex; gap: .55rem; max-width: 280px; min-width: 210px; padding: .55rem .75rem; }
        .areas-search input { background: transparent; border: 0; color: #26372e; min-width: 0; outline: 0; width: 100%; }
        .areas-search:focus-within { border-color: #70ac79; box-shadow: 0 0 0 3px rgba(57,169,0,.1); }
        .areas-table { --bs-table-bg: #fff; --bs-table-hover-bg: #f3f9f4; }
        .areas-table thead th { background: #f2f7f3; border-bottom: 1px solid #e2ebe4; color: #52645a; font-size: .76rem; font-weight: 800; letter-spacing: .04em; padding: .85rem 1.1rem; text-transform: uppercase; }
        .areas-table tbody td { border-color: #edf2ee; padding: .75rem 1.1rem; }
        .areas-number-heading, .areas-number { text-align: center; width: 70px; }
        .areas-number { color: #718078; font-size: .86rem; font-weight: 700; }
        .area-name { align-items: center; display: inline-flex; gap: .75rem; }
        .area-name strong { color: #293c30; font-size: .93rem; font-weight: 650; }
        .area-row-icon { align-items: center; background: #e9f5eb; border-radius: 9px; color: #27803c; display: inline-flex; height: 36px; justify-content: center; width: 36px; }
        .area-actions { align-items: center; display: inline-flex; gap: .4rem; }
        .area-actions form { display: inline-flex; margin: 0; }
        .area-action-btn { align-items: center; border: 1px solid transparent; border-radius: 8px; display: inline-flex; height: 34px; justify-content: center; text-decoration: none; transition: background .16s, transform .16s; width: 36px; }
        .area-action-btn:hover { transform: translateY(-1px); }
        .area-view-btn { background: #eaf2ff; color: #2862ad; }
        .area-view-btn:hover { background: #dceaff; color: #174b91; }
        .area-edit-btn { background: #fff3dc; color: #98620a; }
        .area-edit-btn:hover { background: #ffe8bd; color: #744800; }
        .area-delete-btn { background: #fff0ef; color: #b43a34; }
        .area-delete-btn:hover { background: #ffddda; color: #922a25; }
        .areas-empty { align-items: center; color: #718078; display: flex; flex-direction: column; padding: 2.6rem 1rem; text-align: center; }
        .areas-empty-icon { align-items: center; background: #e9f5eb; border-radius: 16px; color: #27803c; display: inline-flex; font-size: 1.5rem; height: 56px; justify-content: center; margin-bottom: .8rem; width: 56px; }
        .areas-empty strong { color: #293c30; font-size: 1.05rem; }
        .areas-empty p { margin: .35rem 0 1rem; }
        .areas-empty .areas-create-btn { background: var(--areas-accent); color: #fff; }
        .areas-empty .areas-create-btn:hover { background: #2f8f00; color: #fff; }
        .areas-list-footer { background: #fbfcfb; border-top: 1px solid #edf2ee; color: #718078; font-size: .82rem; padding: .8rem 1.4rem; }
        .areas-list-footer i { color: #4c8b55; margin-right: .35rem; }
        @media (max-width: 640px) { .areas-hero { align-items: flex-start; flex-direction: column; gap: 1rem; } .areas-hero-mark { display: none; } .areas-list-heading { align-items: stretch; flex-direction: column; } .areas-search { max-width: none; min-width: 0; } .areas-table thead th, .areas-table tbody td { padding-left: .7rem; padding-right: .7rem; } .areas-number-heading, .areas-number { width: 40px; } }
    </style>

    @if ($areas->isNotEmpty())
        <script>
            const areaSearch = document.getElementById('areaSearch');
            const areaRows = document.querySelectorAll('.area-row');
            const areasNoResults = document.getElementById('areasNoResults');

            areaSearch.addEventListener('input', function () {
                const query = this.value.trim().toLocaleLowerCase();
                let visibleRows = 0;

                areaRows.forEach(function (row) {
                    const matches = row.textContent.toLocaleLowerCase().includes(query);
                    row.classList.toggle('d-none', !matches);
                    visibleRows += matches ? 1 : 0;
                });

                areasNoResults.classList.toggle('d-none', visibleRows > 0);
            });
        </script>
    @endif
@endsection
