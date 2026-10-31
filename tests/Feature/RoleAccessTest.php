<?php

namespace Tests\Feature;

use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    public function test_root_page_identifies_the_api_application(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('API AdminSena')
            ->assertSee('ClienteAdminSena');
    }

    public function test_frontend_routes_are_not_published_by_the_api_application(): void
    {
        foreach ([
            '/home',
            '/iniciar-sesion',
            '/areas/create',
            '/course/admin',
            '/perfil',
        ] as $uri) {
            $this->get($uri)->assertNotFound();
        }
    }
}
