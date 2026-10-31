<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AdminSena - Panel de Administración</title>
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts (Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --sena-green: #39A900;
            --sena-green-dark: #003217;
            --sena-green-light: #48d100;
            --sena-bg: #f8fafc;
        }

        body {
            background-color: var(--sena-bg);
            font-family: 'Inter', sans-serif;
            color: #334155;
            margin: 0;
            overflow-x: hidden;
        }

        /* ESTRUCTURA GENERAL */
        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
            min-height: 100vh;
        }

        /* SIDEBAR CON DEGRADADO INSTITUCIONAL */
        #sidebar {
            min-width: 270px;
            max-width: 270px;
            height: 100vh;
            overflow-y: auto;
            align-self: flex-start;
            background: linear-gradient(160deg, #0b4526 0%, #031c0e 60%, #010c06 100%);
            color: #fff;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 6px 0 25px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            position: sticky;
            top: 0;
        }

        #sidebar img {
            max-width: 130px !important;
            height: auto !important;
            display: block !important;
            margin: 1.8rem auto 1.2rem auto !important;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.4));
            transition: transform 0.3s ease;
        }
        #sidebar img:hover {
            transform: scale(1.05);
        }

        #sidebar ul {
            padding-left: 0 !important;
            list-style: none !important;
            margin-top: 1rem;
        }

        #sidebar li {
            list-style: none !important;
            margin: 0.3rem 0.8rem;
        }

        /* EFECTOS AL TOCAR CADA BOTÓN Y ENLACE DEL SIDEBAR */
        #sidebar a {
            color: #e2e8f0 !important;
            text-decoration: none !important;
            display: flex !important;
            align-items: center !important;
            gap: 14px !important;
            padding: 0.8rem 1.1rem !important;
            border-radius: 10px !important;
            font-weight: 500 !important;
            font-size: 0.95rem !important;
            background: transparent;
            transition: all 0.25s ease-in-out;
            position: relative;
            overflow: hidden;
        }

        #sidebar a:hover {
            background: linear-gradient(90deg, rgba(57, 169, 0, 0.35) 0%, rgba(57, 169, 0, 0.05) 100%) !important;
            color: #ffffff !important;
            transform: translateX(6px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            border-left: 4px solid var(--sena-green-light);
        }

        #sidebar a:active {
            transform: scale(0.97) translateX(6px);
            background: rgba(57, 169, 0, 0.5) !important;
        }

        /* CONTENEDOR PRINCIPAL */
        #content {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all 0.35s ease;
        }

        .top-navbar {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.75rem 2rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        }

        .main-body-container {
            padding: 2.5rem;
            flex-grow: 1;
        }

        .btn {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            white-space: nowrap;
        }

        .btn-group .btn {
            min-width: 40px;
        }

        .form-select {
            min-height: 44px;
            border-color: #cbd5e1;
            border-radius: 9px;
            padding-left: 0.9rem;
            background-color: #fff;
        }

        .form-select:focus {
            border-color: var(--sena-green);
            box-shadow: 0 0 0 0.2rem rgba(57, 169, 0, 0.14);
        }

        .table-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.4rem;
            flex-wrap: wrap;
        }

        /* ESTILOS DEL BOTÓN DE USUARIO / PERFIL */
        .user-dropdown-btn {
            background: var(--sena-green-dark);
            border: 2px solid var(--sena-green);
            color: #ffffff;
            border-radius: 50px;
            padding: 0.4rem 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }
        .user-dropdown-btn:hover {
            background-color: var(--sena-green);
            color: #fff;
            box-shadow: 0 4px 12px rgba(57, 169, 0, 0.25);
        }

        .user-dropdown-btn i {
            color: #b7e892 !important;
        }

        .top-navbar .dropdown-menu {
            min-width: 230px;
            padding: 0.55rem;
            background: #063b24;
            border: 1px solid rgba(57, 169, 0, 0.55) !important;
            border-radius: 12px;
            box-shadow: 0 14px 32px rgba(0, 25, 14, 0.3) !important;
        }

        .top-navbar .dropdown-header {
            padding: 0.55rem 0.75rem 0.4rem;
            letter-spacing: 0.04em;
            font-size: 0.72rem;
            color: #b7e892;
        }

        .top-navbar .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            min-height: 42px;
            border-radius: 8px;
            font-weight: 500;
            color: #f4fff1;
        }

        .top-navbar .dropdown-item:hover,
        .top-navbar .dropdown-item:focus {
            background: var(--sena-green);
            color: #ffffff;
        }

        .top-navbar .dropdown-item i {
            width: 20px;
            text-align: center;
        }

        .top-navbar .dropdown-divider {
            border-color: rgba(183, 232, 146, 0.24);
        }

        .top-navbar .dropdown-menu form {
            display: block;
            margin: 0;
        }

        /* TARJETAS Y BOTONES GENERALES */
        .card, .form-container-box {
            border: none;
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.04);
            background: #ffffff;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--sena-green), #2e8600) !important;
            border: none !important;
            border-radius: 8px !important;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(57, 169, 0, 0.3);
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(57, 169, 0, 0.4);
        }

        #sidebarCollapse {
            border: 2px solid var(--sena-green);
            color: var(--sena-green-dark);
            background: #f1f8ec;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        #sidebarCollapse:hover {
            background-color: var(--sena-green);
            color: #fff;
            transform: scale(1.05);
        }

        /* RESPONSIVIDAD MÓVIL */
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -270px;
                position: fixed;
                height: 100vh;
                top: 0;
                left: 0;
                overflow-y: auto;
            }
            #sidebar.mobile-open {
                margin-left: 0;
            }
            .top-navbar {
                padding: 0.75rem 1rem;
            }
            .main-body-container {
                padding: 1.25rem;
            }
            .user-dropdown-btn span {
                display: none;
            }
            .user-dropdown-btn {
                padding: 0.55rem 0.75rem;
            }
            .table-actions {
                justify-content: flex-start;
            }
        }

        :root {
            --sena-green: #39a900;
            --sena-green-dark: #0f3823;
            --sena-sidebar: #0f3823;
            --sena-bg: #f6f8fa;
        }

        body {
            background: var(--sena-bg);
            color: #273a31;
        }

        html,
        body,
        #sidebar {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        html::-webkit-scrollbar,
        body::-webkit-scrollbar,
        #sidebar::-webkit-scrollbar {
            display: none;
        }

        #sidebar {
            display: flex;
            min-width: 160px;
            max-width: 160px;
            flex: 0 0 160px;
            flex-direction: column;
            height: 100vh;
            overflow-x: hidden;
            overflow-y: auto;
            background: var(--sena-sidebar);
            box-shadow: 4px 0 16px rgba(8, 37, 22, .13);
        }

        .sidebar-brand {
            padding: 1rem 0.75rem 0.65rem;
            border-bottom: 1px solid rgba(255, 255, 255, .12);
            background: var(--sena-sidebar);
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            flex-direction: column;
            gap: 0.3rem;
            padding: 0.65rem 0.35rem;
            border-radius: 10px;
            background: transparent !important;
            color: #fff !important;
            font-size: 0.9rem;
            font-weight: 750;
            text-decoration: none !important;
        }

        #sidebar .sidebar-logo:hover,
        #sidebar .sidebar-logo:focus-visible {
            background: transparent !important;
            color: #fff !important;
            transform: none !important;
            box-shadow: none !important;
        }

        #sidebar .sidebar-logo img {
            width: 104px;
            max-width: 100% !important;
            height: 92px;
            margin: 0 !important;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }

        .sidebar-navigation {
            padding: 0.35rem 0.55rem;
        }

        #sidebar .sidebar-section-title {
            margin: 0.65rem 0.55rem 0.3rem;
            color: #a9c8b3;
            font-size: 0.61rem;
            font-weight: 800;
            letter-spacing: .09em;
            text-transform: uppercase;
        }

        #sidebar .sidebar-link {
            display: flex !important;
            min-height: 42px;
            align-items: center;
            gap: 0.65rem !important;
            margin: 0.13rem 0;
            padding: 0.62rem 0.72rem !important;
            overflow: visible;
            border: 1px solid transparent;
            border-radius: 9px !important;
            background: rgba(255, 255, 255, .025);
            color: #e6f1e9 !important;
            font-size: 0.78rem !important;
            font-weight: 600 !important;
            transform: none;
            box-shadow: none;
        }

        #sidebar .sidebar-link i {
            width: 17px;
            color: #c7e2ce;
            font-size: 0.82rem;
            text-align: center;
        }

        #sidebar .sidebar-link:hover,
        #sidebar .sidebar-link.active {
            border-color: rgba(164, 227, 128, .2);
            background: rgba(88, 157, 105, .34) !important;
            color: #fff !important;
            transform: none;
            box-shadow: none;
        }

        #sidebar .sidebar-link.active {
            background: rgba(88, 157, 105, .43) !important;
        }

        #sidebar .sidebar-footer {
            margin-top: auto;
            padding: 0.55rem 0.65rem 0.8rem;
        }

        #sidebar .role-btn,
        #sidebar .sidebar-login-link {
            display: flex;
            width: 100%;
            min-height: 40px;
            align-items: center;
            gap: 0.65rem;
            padding: 0.55rem 0.7rem;
            border: 1px solid rgba(195, 231, 204, .32);
            border-radius: 8px;
            background: transparent;
            color: #eef8f0 !important;
            font-size: 0.77rem;
            text-decoration: none;
        }

        #sidebar .role-btn:hover,
        #sidebar .sidebar-login-link:hover {
            background: rgba(255, 255, 255, .09);
        }

        #sidebar .user-info {
            display: flex;
            flex-direction: column;
            margin-top: 0.5rem;
            color: #dcebe0;
            font-size: 0.72rem;
        }

        #sidebar.collapsed {
            min-width: 56px;
            max-width: 56px;
            flex-basis: 56px;
            margin-left: 0;
        }

        #sidebar.collapsed .sidebar-brand {
            padding: 0.55rem 0.35rem;
        }

        #sidebar.collapsed .sidebar-logo {
            gap: 0;
        }

        #sidebar.collapsed .sidebar-logo img {
            width: 38px;
            height: 40px;
        }

        #sidebar.collapsed .sidebar-logo span,
        #sidebar.collapsed .sidebar-section-title,
        #sidebar.collapsed .sidebar-link span {
            display: none;
        }

        #sidebar.collapsed .sidebar-navigation {
            display: flex;
            flex: 1;
            flex-direction: column;
            justify-content: space-evenly;
            gap: 0;
            padding: 0.65rem 0.3rem;
        }

        #sidebar.collapsed .sidebar-link {
            width: 42px;
            min-height: 42px;
            justify-content: center;
            gap: 0 !important;
            margin: 0 auto;
            padding: 0.45rem !important;
            border-radius: 10px !important;
        }

        #sidebar.collapsed .sidebar-link i {
            width: auto;
            font-size: 0.92rem;
        }

        #sidebar.collapsed .sidebar-footer {
            display: none;
        }

        #content {
            min-width: 0;
            min-height: 100vh;
            background: var(--sena-bg);
        }

        .top-navbar {
            min-height: 64px;
            padding: 0.55rem 1rem;
            border-bottom: 1px solid #e3eae5;
            box-shadow: 0 2px 7px rgba(26, 52, 37, .035);
        }

        .top-navbar > .container-fluid {
            display: grid;
            grid-template-columns: minmax(72px, 1fr) minmax(220px, 560px) minmax(150px, 1fr);
            align-items: center;
            column-gap: clamp(0.75rem, 1.5vw, 1.5rem);
        }

        .top-nav-start,
        .top-nav-actions {
            display: flex;
            align-items: center;
        }

        .top-nav-start {
            justify-self: start;
            gap: 0.55rem;
        }

        .top-nav-actions {
            justify-self: end;
            gap: 0.5rem;
        }

        .top-home-btn,
        #sidebarCollapse,
        .notification-btn {
            flex: 0 0 auto;
            min-width: 34px;
            min-height: 34px;
            margin: 0 !important;
            padding: 0.35rem 0.5rem !important;
            border: 1px solid #a6c8b1 !important;
            border-radius: 8px !important;
            background: #f3faf5 !important;
            color: #17442b !important;
            box-shadow: none !important;
        }

        .top-home-btn:hover,
        #sidebarCollapse:hover,
        .notification-btn:hover {
            background: #e3f3e7 !important;
            color: #0f3823 !important;
            transform: none;
        }

        .top-search {
            width: 100%;
            min-width: 0;
            max-width: 560px;
            justify-self: center;
            margin: 0;
        }

        .top-nav-actions {
            white-space: nowrap;
        }

        .user-dropdown-btn {
            min-height: 34px;
            padding: 0.3rem 0.65rem;
            border: 1px solid #8db99a;
            border-radius: 8px;
            background: #f3faf5;
            color: #17442b;
            font-size: 0.75rem;
        }

        .user-dropdown-btn:hover {
            background: #e3f3e7;
            color: #0f3823;
            box-shadow: none;
        }

        .user-dropdown-btn i {
            color: #287144 !important;
        }

        .notification-btn {
            position: relative;
        }

        .notification-dot {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 7px;
            height: 7px;
            border: 1px solid #fff;
            border-radius: 50%;
            background: #39a900;
        }

        .main-body-container {
            flex: 1 0 auto;
            padding: 1.35rem 1.7rem;
        }

        .page-heading {
            margin-bottom: 1rem !important;
        }

        footer.text-center {
            background: #0f3823 !important;
            border-top-color: #39a900 !important;
        }

        footer.text-center > .text-center {
            background: #4e8831 !important;
        }

        @media (max-width: 768px) {
            #sidebar {
                position: fixed;
                z-index: 1100;
                width: 140px;
                min-width: 140px;
                max-width: 140px;
                margin-left: -140px;
            }

            #sidebar.mobile-open {
                min-width: 140px;
                margin-left: 0;
            }

            #sidebar.collapsed {
                min-width: 140px;
                max-width: 140px;
                flex-basis: 140px;
            }

            #sidebar.collapsed .sidebar-brand {
                padding: 1rem 0.75rem 0.65rem;
            }

            #sidebar.collapsed .sidebar-logo {
                gap: 0.3rem;
            }

            #sidebar.collapsed .sidebar-logo img {
                width: 104px;
                height: 92px;
            }

            #sidebar.collapsed .sidebar-logo span,
            #sidebar.collapsed .sidebar-section-title,
            #sidebar.collapsed .sidebar-link span {
                display: initial;
            }

            #sidebar.collapsed .sidebar-navigation {
                display: block;
                padding: 0.35rem 0.55rem;
            }

            #sidebar.collapsed .sidebar-link {
                width: auto;
                min-height: 42px;
                justify-content: flex-start;
                gap: 0.65rem !important;
                margin: 0.13rem 0;
                padding: 0.62rem 0.72rem !important;
            }

            #sidebar.collapsed .sidebar-link i {
                width: 17px;
            }

            .top-navbar {
                padding: 0.55rem 0.7rem;
            }

            .top-navbar > .container-fluid {
                grid-template-columns: auto minmax(0, 1fr) auto;
                column-gap: 0.55rem;
            }

            .top-nav-start,
            .top-nav-actions {
                gap: 0.35rem;
            }

            .top-search {
                max-width: none;
            }

            .main-body-container {
                padding: 1rem;
            }

            .user-dropdown-btn span {
                display: inline;
            }
        }

        @media (max-width: 480px) {
            .top-navbar > .container-fluid {
                column-gap: 0.35rem;
            }

            .top-nav-start,
            .top-nav-actions {
                gap: 0.25rem;
            }

            .user-dropdown-btn span {
                display: none;
            }

            .user-dropdown-btn {
                min-width: 34px;
                justify-content: center;
                padding: 0.3rem !important;
            }
        }

        body.role-teacher #sidebar {
            background: linear-gradient(160deg, #123d56 0%, #092638 60%, #061923 100%);
        }

        body.role-teacher #sidebar .sidebar-link.active,
        body.role-teacher #sidebar .sidebar-link:hover {
            background: linear-gradient(90deg, rgba(47, 166, 183, .38), rgba(47, 166, 183, .06)) !important;
            border-left-color: #48c5d2;
        }

        body.role-teacher .top-navbar {
            border-bottom: 3px solid #2fa6b7;
        }

        body.role-apprentice #sidebar {
            background: linear-gradient(160deg, #45306d 0%, #2d2048 60%, #1c1530 100%);
        }

        body.role-apprentice #sidebar .sidebar-link.active,
        body.role-apprentice #sidebar .sidebar-link:hover {
            background: linear-gradient(90deg, rgba(242, 173, 72, .36), rgba(242, 173, 72, .06)) !important;
            border-left-color: #f2ad48;
        }

        body.role-apprentice .top-navbar {
            border-bottom: 3px solid #f2ad48;
        }
    </style>
</head>
<body class="@if (auth()->check() && auth()->user()->role === 'teacher') role-teacher @elseif (auth()->check() && auth()->user()->role === 'apprentice') role-apprentice @endif">

    <div class="wrapper">
        
        <!-- Sidebar con degradado y efectos -->
            <nav id="sidebar">
            @include('includes.navbar')
        </nav>

        <!-- Contenido de la derecha -->
        <div id="content">
            
            <!-- Barra superior con Hamburguesa, Buscador y Menú de Usuario -->
            <nav class="navbar top-navbar navbar-expand-lg navbar-light bg-white">
                <div class="container-fluid px-0">
                    <div class="top-nav-start">
                        <a href="{{ route('home') }}" class="btn top-home-btn" title="Ir al inicio" aria-label="Ir al inicio">
                            <i class="fas fa-house"></i>
                        </a>
                        <button type="button" id="sidebarCollapse" class="btn" aria-label="Abrir o cerrar menú" aria-controls="sidebar" aria-expanded="true">
                            <i id="sidebarCollapseIcon" class="fas fa-bars fa-lg"></i>
                        </button>
                    </div>

                    <div class="top-search">
                        @unless (auth()->check() && in_array(auth()->user()->role, ['teacher', 'apprentice'], true))
                            @include('admin.search-bar')
                        @endunless
                    </div>

                    <div class="top-nav-actions">
                        @unless (auth()->check() && in_array(auth()->user()->role, ['teacher', 'apprentice'], true))
                            <a href="{{ route('notifications.index') }}" class="btn notification-btn" aria-label="Notificaciones" title="Notificaciones">
                                <i class="fas fa-bell"></i>
                                <span class="notification-dot" aria-hidden="true"></span>
                            </a>
                        @endunless
                        <div class="dropdown">
                        <button class="btn user-dropdown-btn dropdown-toggle" type="button" id="userMenuDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle fa-lg text-success"></i>
                            <span>Mi Cuenta</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2 py-2" aria-labelledby="userMenuDropdown">
                            @auth
                                <li>
                                    <h6 class="dropdown-header text-uppercase fw-bold text-success">Mi perfil</h6>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2" href="{{ route('profile') }}">
                                        <i class="fas fa-id-card me-2 text-info"></i> Ver perfil
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2" href="{{ route('profile.edit') }}">
                                        <i class="fas fa-user-edit me-2 text-primary"></i> Editar perfil
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 text-danger fw-semibold">
                                            <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
                                        </button>
                                    </form>
                                </li>
                            @else
                                <li>
                                    <a class="dropdown-item py-2 text-success fw-semibold" href="{{ route('login') }}">
                                        <i class="fas fa-right-to-bracket me-2"></i> Iniciar sesión
                                    </a>
                                </li>
                            @endauth
                        </ul>
                        </div>
                    </div>

                </div>
            </nav>

            <!-- Contenido Principal -->
            <div class="main-body-container">
                @unless(request()->is('/') || request()->routeIs('home', 'notifications.*', 'course.index', 'news.index'))
                <div class="page-heading">
                    <h2 class="fw-bold" style="color: var(--sena-green-dark) !important;">
                        @yield('Titulo', 'AdminSena')
                    </h2>
                    <p class="text-muted m-0">Plataforma de Gestión Académica e Institucional</p>
                </div>
                @endunless

                <!-- Alertas de Errores -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle fa-2x me-3 text-danger"></i>
                            <div>
                                <strong>¡Atención!</strong> Revisa los campos requeridos:
                                <ul class="mb-0 mt-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Alertas de Éxito -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle fa-2x me-3 text-success"></i>
                            <div><strong>¡Éxito!</strong> {{ session('success') }}</div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Vista específica -->
                @yield('contenido')
                @yield('content')
            </div>

            <!-- Footer -->
            @include('includes.footerFormulario')
        </div>
    </div>

    <!-- Modal de Rol -->
    @include('admin.role-modal')

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Script de control para la hamburguesa -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarCollapse');
        const sidebarToggleIcon = document.getElementById('sidebarCollapseIcon');

        function syncSidebarToggle() {
            const isMobile = window.innerWidth <= 768;
            const isExpanded = isMobile
                ? sidebar.classList.contains('mobile-open')
                : !sidebar.classList.contains('collapsed');

            sidebarToggle.setAttribute('aria-expanded', isExpanded);
            sidebarToggleIcon.classList.toggle('fa-bars', !isMobile || !isExpanded);
            sidebarToggleIcon.classList.toggle('fa-xmark', isMobile && isExpanded);
        }

        sidebar.classList.remove('active', 'mobile-open');
        syncSidebarToggle();

        sidebarToggle.addEventListener('click', function () {
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('mobile-open');
                sidebar.classList.remove('collapsed');
            } else {
                sidebar.classList.toggle('collapsed');
                sidebar.classList.remove('mobile-open');
            }

            syncSidebarToggle();
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('collapsed');
            } else {
                sidebar.classList.remove('mobile-open', 'active');
            }

            syncSidebarToggle();
        });

        document.querySelectorAll('#sidebar a').forEach(function (link) {
            link.addEventListener('click', function () {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('mobile-open');
                    syncSidebarToggle();
                }
            });
        });
    </script>
</body>
</html>