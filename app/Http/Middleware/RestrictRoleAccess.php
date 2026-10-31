<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictRoleAccess
{
    private const ALLOWED_ROUTES = [
        'teacher' => [
            'home',
            'teacher.index',
            'teacher.show',
            'aprendiz.index',
            'apprentice.show',
            'area.index',
            'area.show',
            'course.index',
            'course.show',
            'trainingcenter.index',
            'trainingcenter.show',
            'profile',
            'profile.edit',
            'profile.update',
            'logout',
            'admin.switch-role',
        ],
        'apprentice' => [
            'home',
            'course.index',
            'course.show',
            'news.index',
            'offers.index',
            'profile',
            'profile.edit',
            'profile.update',
            'logout',
            'admin.switch-role',
        ],
    ];

    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return $next($request);
        }

        $role = auth()->user()->role;
        $allowedRoutes = self::ALLOWED_ROUTES[$role] ?? null;

        if ($allowedRoutes === null) {
            return $next($request);
        }

        $routeName = $request->route()->getName();
        $isRootHome = $request->route()->uri() === '/';

        abort_unless($isRootHome || in_array($routeName, $allowedRoutes, true), 403);

        return $next($request);
    }
}
