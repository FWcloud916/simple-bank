<?php

namespace Tests\Feature\Controllers;

use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_register()
    {
        $response = $this->post('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'account' => 'Test Account',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'token',
                'user' => [
                    'id',
                    'name',
                    'email',
                    'account',
                    'created_at',
                    'updated_at',
                ]
            ],
        ]);
    }

    public function test_can_login()
    {
        $user = $this->setNewUser();

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'token',
                'user' => [
                    'id',
                    'name',
                    'email',
                    'account',
                    'created_at',
                    'updated_at',
                ]
            ],
        ]);
    }

    public function test_can_logout()
    {
        $user = $this->setNewUser();

        Sanctum::actingAs($user);
        $response = $this->get('/api/logout');
        $response->assertStatus(200);
    }

}
