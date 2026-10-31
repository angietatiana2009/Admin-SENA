@extends('layouts.app')
@section('Titulo', 'Quiénes Somos')
@section('contenido')
    <!-- Banner Principal -->
    <div class="banner">
        <h1><i class="fas fa-info-circle"></i> Quiénes Somos</h1>
        <p>Conoce más sobre AdminSena - Sistema de Gestión Académica del SENA</p>
    </div>

    <!-- Sección Misión, Visión y Valores -->
    <div class="row g-4 mb-5">
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <div style="background: linear-gradient(135deg, #39A900, #0d4f2f); width: 70px; height: 70px; border-radius: 15px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; color: white; font-size: 32px;">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h4 class="card-title" style="color: #0d4f2f; font-weight: 700;">Misión</h4>
                    <p class="card-text" style="color: #64748b; line-height: 1.8;">
                        Proporcionar una plataforma de administración académica integral que permita
                        a las instituciones de formación del SENA gestionar eficientemente todos los
                        aspectos relacionados con cursos, aprendices, instructores y recursos educativos.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <div style="background: linear-gradient(135deg, #39A900, #0d4f2f); width: 70px; height: 70px; border-radius: 15px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; color: white; font-size: 32px;">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h4 class="card-title" style="color: #0d4f2f; font-weight: 700;">Visión</h4>
                    <p class="card-text" style="color: #64748b; line-height: 1.8;">
                        Ser la herramienta tecnológica de referencia en la gestión académica de
                        centros de formación, facilitando la calidad educativa y la eficiencia
                        administrativa en todo el sistema SENA.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <div style="background: linear-gradient(135deg, #39A900, #0d4f2f); width: 70px; height: 70px; border-radius: 15px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; color: white; font-size: 32px;">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h4 class="card-title" style="color: #0d4f2f; font-weight: 700;">Valores</h4>
                    <ul class="list-unstyled" style="color: #64748b; line-height: 2;">
                        <li><strong style="color: #0d4f2f;">✓ Excelencia:</strong> Calidad en cada funcionalidad</li>
                        <li><strong style="color: #0d4f2f;">✓ Innovación:</strong> Mejora continua</li>
                        <li><strong style="color: #0d4f2f;">✓ Transparencia:</strong> Información clara</li>
                        <li><strong style="color: #0d4f2f;">✓ Responsabilidad:</strong> Compromiso educativo</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección Funcionalidades Principales -->
    <div class="mb-5">
        <h2 class="mb-4" style="color: #0d4f2f; font-weight: 800; text-align: center;">
            <i class="fas fa-cogs"></i> Funcionalidades Principales
        </h2>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0 text-center">
                    <div class="card-body">
                        <div style="font-size: 48px; color: #39A900; margin-bottom: 20px;">
                            <i class="fas fa-users"></i>
                        </div>
                        <h5 class="card-title" style="color: #0d4f2f; font-weight: 700;">Gestión de Aprendices</h5>
                        <p class="card-text" style="color: #64748b;">Administra datos, progreso y evaluaciones de aprendices</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0 text-center">
                    <div class="card-body">
                        <div style="font-size: 48px; color: #39A900; margin-bottom: 20px;">
                            <i class="fas fa-book"></i>
                        </div>
                        <h5 class="card-title" style="color: #0d4f2f; font-weight: 700;">Control de Cursos</h5>
                        <p class="card-text" style="color: #64748b;">Crea y gestiona cursos con cronograma detallado</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0 text-center">
                    <div class="card-body">
                        <div style="font-size: 48px; color: #39A900; margin-bottom: 20px;">
                            <i class="fas fa-chalkboard-user"></i>
                        </div>
                        <h5 class="card-title" style="color: #0d4f2f; font-weight: 700;">Instructores</h5>
                        <p class="card-text" style="color: #64748b;">Asigna y monitorea instructores por área</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0 text-center">
                    <div class="card-body">
                        <div style="font-size: 48px; color: #39A900; margin-bottom: 20px;">
                            <i class="fas fa-desktop"></i>
                        </div>
                        <h5 class="card-title" style="color: #0d4f2f; font-weight: 700;">Gestión de Equipos</h5>
                        <p class="card-text" style="color: #64748b;">Gestiona inventario de computadores y recursos</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0 text-center">
                    <div class="card-body">
                        <div style="font-size: 48px; color: #39A900; margin-bottom: 20px;">
                            <i class="fas fa-building"></i>
                        </div>
                        <h5 class="card-title" style="color: #0d4f2f; font-weight: 700;">Centros de Formación</h5>
                        <p class="card-text" style="color: #64748b;">Administra múltiples sedes y ubicaciones</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0 text-center">
                    <div class="card-body">
                        <div style="font-size: 48px; color: #39A900; margin-bottom: 20px;">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <h5 class="card-title" style="color: #0d4f2f; font-weight: 700;">Áreas de Conocimiento</h5>
                        <p class="card-text" style="color: #64748b;">Organiza contenido por áreas especializadas</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección Información SENA -->
    <div class="card shadow-lg border-0" style="background: linear-gradient(135deg, #0d4f2f, #1e6d3b); color: white; margin-top: 50px;">
        <div class="card-body p-5 text-center">
            <h2 class="card-title mb-4" style="font-weight: 800; font-size: 2rem;">
                <i class="fas fa-institution"></i> Desarrollado por SENA
            </h2>
            <p class="card-text lead mb-4" style="font-size: 1.1rem; line-height: 1.8;">
                AdminSena es un proyecto de transformación digital del <strong>Servicio Nacional de Aprendizaje (SENA)</strong>,
                diseñado para modernizar la gestión académica y administrativa de sus centros de formación a nivel nacional.
            </p>
            
            <div class="row mt-5">
                <div class="col-md-4 mb-3">
                    <div style="background: rgba(255,255,255,0.1); padding: 20px; border-radius: 10px;">
                        <h5 style="font-weight: 700; margin-bottom: 10px;">
                            <i class="fas fa-tag"></i> Versión
                        </h5>
                        <p style="font-size: 1.3rem; font-weight: 600;">1.0.0</p>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div style="background: rgba(255,255,255,0.1); padding: 20px; border-radius: 10px;">
                        <h5 style="font-weight: 700; margin-bottom: 10px;">
                            <i class="fas fa-calendar"></i> Año
                        </h5>
                        <p style="font-size: 1.3rem; font-weight: 600;">2026</p>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div style="background: rgba(255,255,255,0.1); padding: 20px; border-radius: 10px;">
                        <h5 style="font-weight: 700; margin-bottom: 10px;">
                            <i class="fas fa-building"></i> Institución
                        </h5>
                        <p style="font-size: 1.3rem; font-weight: 600;">SENA Colombia</p>
                    </div>
                </div>
            </div>

            <hr style="background: rgba(255,255,255,0.2); margin-top: 30px; margin-bottom: 30px;">

            <p style="font-size: 0.95rem; color: #cbd5e1;">
                <i class="fas fa-globe"></i> Plataforma de Gestión Académica Integral | 
                <i class="fas fa-shield-alt"></i> Segura y Confiable | 
                <i class="fas fa-users-cog"></i> Administración Completa
            </p>
        </div>
    </div>

    <!-- Sección de Características Destacadas -->
    <div class="alert alert-info border-0 mt-5" style="background: rgba(59, 130, 246, 0.1); border-left: 4px solid #3b82f6; color: #1e40af;">
        <h5 style="font-weight: 700; margin-bottom: 15px;">
            <i class="fas fa-lightbulb"></i> ¿Por qué elegir AdminSena?
        </h5>
        <div class="row">
            <div class="col-md-6">
                <ul class="list-unstyled">
                    <li><i class="fas fa-check" style="color: #39A900; margin-right: 10px;"></i> <strong>Interfaz intuitiva</strong> y fácil de usar</li>
                    <li><i class="fas fa-check" style="color: #39A900; margin-right: 10px;"></i> <strong>Seguridad de datos</strong> garantizada</li>
                    <li><i class="fas fa-check" style="color: #39A900; margin-right: 10px;"></i> <strong>Soporte técnico</strong> disponible</li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="list-unstyled">
                    <li><i class="fas fa-check" style="color: #39A900; margin-right: 10px;"></i> <strong>Actualización continua</strong> de funciones</li>
                    <li><i class="fas fa-check" style="color: #39A900; margin-right: 10px;"></i> <strong>Compatibilidad</strong> con todos los navegadores</li>
                    <li><i class="fas fa-check" style="color: #39A900; margin-right: 10px;"></i> <strong>Reportes detallados</strong> y análisis</li>
                </ul>
            </div>
        </div>
    </div>

@endsection
