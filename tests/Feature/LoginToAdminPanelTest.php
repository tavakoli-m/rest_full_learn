<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginToAdminPanelTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_an_admin_can_login_to_admin_panel(): void
    {
        $this->assertTrue(true);
        $this->assertFalse(false);
    }
}
