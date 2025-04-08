<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
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

    public function test_an_admin_can_register_new_user()
    {
        $user = User::whereEmail('admin@gmail.com')->first();

        $response = $this->actingAs($user)->post('api/user',[
            'first_name' => 'test',
            'last_name' => 'test last name',
            'email' => 'test@gmail.com',
            'password' => Hash::make('12345678'),
        ])->assertStatus(200)
        ->assertJsonStructure(['message'])
        ->assertJson(['message' => 'User created successfully']);

        $registeredUser = User::findOrFail($response->json('data')['id']);

        $this->assertEquals($registeredUser->email,'test@gmail.com');
    }
}
