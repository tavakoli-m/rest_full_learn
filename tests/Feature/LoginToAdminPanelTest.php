<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginToAdminPanelTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;
    /**
     * A basic feature test example.
     */
    public function test_an_admin_can_login_to_admin_panel(): void
    {
        $response = $this->post('/api/login',[
            'email' => 'admin@gmail.com',
            'password' => '12345678'
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => ['token']
        ]);

    }
}
