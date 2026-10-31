<div class="sidebar-brand">
    <a href="{{ route('home') }}" class="sidebar-logo" aria-label="SenaGestión, inicio">
        <img src="{{ asset('imagenes/1image.png') }}" alt="Logo SENA">
        <span>SenaGestión</span>
    </a>
</div>

<nav class="sidebar-navigation" aria-label="Navegación principal">
    <p class="sidebar-section-title">Principal</p>
    <a class="sidebar-link {{ request()->is('/') || request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}" title="Inicio">
        <i class="fas fa-house"></i><span>Inicio</span>
    </a>

    @if (auth()->check() && auth()->user()->role === 'teacher')
        <p class="sidebar-section-title">Formación</p>
        <a class="sidebar-link {{ request()->routeIs('course.index', 'course.show') ? 'active' : '' }}" href="{{ route('course.index') }}" title="Cursos">
            <i class="fas fa-book"></i><span>Cursos</span>
        </a>
        <a class="sidebar-link {{ request()->routeIs('teacher.index', 'teacher.show') ? 'active' : '' }}" href="{{ route('teacher.index') }}" title="Instructores">
            <i class="fas fa-chalkboard-user"></i><span>Instructores</span>
        </a>
        <a class="sidebar-link {{ request()->routeIs('aprendiz.index', 'apprentice.show') ? 'active' : '' }}" href="{{ route('aprendiz.index') }}" title="Aprendices">
            <i class="fas fa-user-graduate"></i><span>Aprendices</span>
        </a>
        <a class="sidebar-link {{ request()->routeIs('area.index', 'area.show') ? 'active' : '' }}" href="{{ route('area.index') }}" title="Áreas">
            <i class="fas fa-layer-group"></i><span>Áreas</span>
        </a>
        <a class="sidebar-link {{ request()->routeIs('trainingcenter.index', 'trainingcenter.show') ? 'active' : '' }}" href="{{ route('trainingcenter.index') }}" title="Centros">
            <i class="fas fa-building"></i><span>Centros</span>
        </a>
    @elseif (auth()->check() && auth()->user()->role === 'apprentice')
        <p class="sidebar-section-title">Formación</p>
        <a class="sidebar-link {{ request()->routeIs('course.index', 'course.show') ? 'active' : '' }}" href="{{ route('course.index') }}" title="Cursos">
            <i class="fas fa-book"></i><span>Cursos</span>
        </a>

        <p class="sidebar-section-title">Comunidad</p>
        <a class="sidebar-link {{ request()->routeIs('news.*') ? 'active' : '' }}" href="{{ route('news.index') }}" title="Noticias">
            <i class="fas fa-newspaper"></i><span>Noticias</span>
        </a>
        <a class="sidebar-link {{ request()->routeIs('offers.*') ? 'active' : '' }}" href="{{ route('offers.index') }}" title="Ofertas">
            <i class="fas fa-briefcase"></i><span>Ofertas</span>
        </a>
    @else
        <p class="sidebar-section-title">Formación</p>
        <a class="sidebar-link {{ request()->routeIs('area.*') ? 'active' : '' }}" href="{{ route('area.create') }}" title="Áreas">
            <i class="fas fa-layer-group"></i><span>Áreas</span>
        </a>
        <a class="sidebar-link {{ request()->routeIs('computer.*') ? 'active' : '' }}" href="{{ route('computer.computador') }}" title="Computadores">
            <i class="fas fa-desktop"></i><span>Computadores</span>
        </a>
        <a class="sidebar-link {{ request()->routeIs('trainingcenter.*') ? 'active' : '' }}" href="{{ route('trainingcenter.registro') }}" title="Centros">
            <i class="fas fa-building"></i><span>Centros</span>
        </a>
        <a class="sidebar-link {{ request()->routeIs('course.*') ? 'active' : '' }}" href="{{ route('course.registro') }}" title="Cursos">
            <i class="fas fa-book"></i><span>Cursos</span>
        </a>
        <a class="sidebar-link {{ request()->routeIs('teacher.*') ? 'active' : '' }}" href="{{ route('teacher.registro') }}" title="Instructores">
            <i class="fas fa-chalkboard-user"></i><span>Instructores</span>
        </a>
        <a class="sidebar-link {{ request()->routeIs('aprendiz.*', 'apprentice.*') ? 'active' : '' }}" href="{{ route('aprendiz.registro') }}" title="Aprendices">
            <i class="fas fa-user-graduate"></i><span>Aprendices</span>
        </a>

        <p class="sidebar-section-title">Comunidad</p>
        <a class="sidebar-link {{ request()->routeIs('notifications.*') ? 'active' : '' }}" href="{{ route('notifications.index') }}" title="Notificaciones">
            <i class="fas fa-bell"></i><span>Notificaciones</span>
        </a>
        <a class="sidebar-link {{ request()->routeIs('news.*') ? 'active' : '' }}" href="{{ route('news.index') }}" title="Noticias">
            <i class="fas fa-newspaper"></i><span>Noticias</span>
        </a>
        <a class="sidebar-link {{ request()->routeIs('offers.*') ? 'active' : '' }}" href="{{ route('offers.index') }}" title="Ofertas">
            <i class="fas fa-briefcase"></i><span>Ofertas</span>
        </a>
        <a class="sidebar-link {{ request()->routeIs('login.*') ? 'active' : '' }}" href="{{ route('login.index') }}" title="Administrador">
            <i class="fas fa-user-shield"></i><span>Administrador</span>
        </a>
    @endif
</nav>

<div class="sidebar-footer">
    <button type="button" class="role-btn" onclick="openRoleModal()">
        <i class="fas fa-user-tag"></i><span>Cambiar rol</span>
    </button>
</div>
