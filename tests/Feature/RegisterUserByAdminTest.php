<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterUserByAdminTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;
    /**
     * A basic feature test example.
     */
    public function test_authentication(): void
    {
        $this->post('/api/user')->assertStatus(401);
    }

    public function test_authorization(): void
    {
        $user = User::whereEmail('user@gmail.com')->first();
        $this->actingAs($user)->post('api/user')->assertStatus(403);
    }

    public function test_validation(): void
    {
        $user = User::whereEmail('admin@gmail.com')->first();
        $this->actingAs($user)->post('api/user',[])->assertStatus(422);
    }
}
