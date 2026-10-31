<!-- Buscador Global -->
<div class="search-container">
    <div class="search-wrapper">
        <div class="search-input-shell">
            <span class="search-icon-wrap">
                <i class="fas fa-search"></i>
            </span>
            <input
                type="text"
                id="searchInput"
                class="search-input"
                placeholder="Buscar áreas, cursos, instructores..."
                autocomplete="off"
            >
        </div>
        <div id="searchResults" class="search-results" style="display: none;"></div>
    </div>
</div>

<style>
    .search-container {
        width: 100%;
        max-width: 520px;
    }

    .search-wrapper {
        position: relative;
        width: 100%;
    }

    .search-input-shell {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        width: 100%;
        padding: 0.3rem 0.55rem;
        background: rgba(255, 255, 255, 0.96);
        border: 1px solid #d6e3d9;
        border-radius: 8px;
        box-shadow: none;
    }

    .search-icon-wrap {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 23px;
        height: 23px;
        border-radius: 50%;
        background: #4e9d69;
        color: #fff;
        flex-shrink: 0;
        font-size: 0.68rem;
    }

    .search-input {
        flex: 1;
        border: none;
        outline: none;
        background: transparent;
        color: #1f2d3d;
        font-size: 0.77rem;
        font-weight: 500;
    }

    .search-input::placeholder {
        color: #6c757d;
    }

    .search-results {
        position: absolute;
        top: calc(100% + 0.55rem);
        left: 0;
        right: 0;
        background: rgba(255, 255, 255, 0.98);
        border: 1px solid rgba(15, 23, 42, 0.08);
        border-radius: 1rem;
        box-shadow: 0 0.8rem 1.8rem rgba(15, 23, 42, 0.12);
        overflow: hidden;
        z-index: 1000;
    }

    .search-result-item {
        border-bottom: 1px solid rgba(15, 23, 42, 0.06);
    }

    .search-result-item:last-child {
        border-bottom: none;
    }

    .search-result-item a {
        display: block;
        padding: 0.8rem 0.9rem;
        color: #1f2d3d;
        text-decoration: none;
        transition: background 0.2s ease;
    }

    .search-result-item a:hover {
        background: rgba(42, 168, 107, 0.06);
    }

    .search-result-name {
        font-weight: 700;
        font-size: 0.95rem;
        margin-bottom: 0.2rem;
    }

    .search-result-type {
        font-size: 0.78rem;
        color: #6c757d;
    }

    .search-no-results {
        padding: 0.9rem 1rem;
        color: #495057;
        font-size: 0.9rem;
    }
</style>

<script>
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');

    if (searchInput && searchResults) {
        searchInput.addEventListener('input', function(e) {
            const query = e.target.value.trim();

            if (query.length < 2) {
                searchResults.style.display = 'none';
                searchResults.innerHTML = '';
                return;
            }

            fetch(`{{ route('admin.search') }}?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.results && data.results.length > 0) {
                        let html = '';
                        data.results.forEach(item => {
                            html += `
                                <div class="search-result-item">
                                    <a href="${item.url}" class="text-decoration-none">
                                        <div class="search-result-name">${item.name}</div>
                                        <div class="search-result-type">
                                            <i class="fas fa-tag"></i> ${item.type}
                                        </div>
                                    </a>
                                </div>
                            `;
                        });
                        searchResults.innerHTML = html;
                        searchResults.style.display = 'block';
                    } else {
                        searchResults.innerHTML = '<div class="search-no-results"><i class="fas fa-search"></i> No se encontraron resultados</div>';
                        searchResults.style.display = 'block';
                    }
                })
                .catch(error => console.error('Error en búsqueda:', error));
        });

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.search-wrapper')) {
                searchResults.style.display = 'none';
            }
        });

        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                searchResults.style.display = 'none';
            }
        });
    }
</script>
