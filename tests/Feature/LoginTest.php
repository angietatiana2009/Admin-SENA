<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_web_login_is_not_published_by_the_api_application(): void
    {
        $this->get('/iniciar-sesion')->assertNotFound();
        $this->post('/iniciar-sesion')->assertNotFound();
    }
}
