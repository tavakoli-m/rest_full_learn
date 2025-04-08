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

    public function test_login_validation(): void
    {
        $response = $this->post('/api/login');

        $response->assertStatus(422);
    }
    public function test_an_admin_can_login_to_admin_panel_with_correct_data(): void
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

    public function test_an_admin_cannot_login_to_admin_panel_with_wrong_data(): void
    {
        $response = $this->post('/api/login',[
            'email' => 'admin@gmail.com',
            'password' => '123'
        ]);

        $response->assertStatus(401);
    }
}
