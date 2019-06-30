<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function testAuth()
    {
        $response = $this->get('/login');

        $credentials = [
            "username" => "gestor",
            "password" => "12345678"
        ];
        $this->get('/login')->assertSee('Inicia sesión')->assertStatus(200);
        $response = $this->post('/login', $credentials);
        $response->assertRedirect('/home');
    }

    public function testAuthUsernameRequired()
    {
        $response = $this->get('/login');

        $credentials = [
            "password" => "12345678"
        ];
        $this->get('/login')->assertSee('Inicia sesión')->assertStatus(200);
        $response = $this->post('/login', $credentials);
        $response->assertRedirect('/login')->assertSessionHasErrors('username');
    }

    public function testAuthPasswordRequired()
    {
        $response = $this->get('/login');

        $credentials = [
            "username" => "gestor"
        ];
        $this->get('/login')->assertSee('Inicia sesión')->assertStatus(200);
        $response = $this->post('/login', $credentials);
        $response->assertRedirect('/login')->assertSessionHasErrors('password');
    }
}
