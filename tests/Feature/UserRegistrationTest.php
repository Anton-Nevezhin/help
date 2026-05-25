<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_user()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'password' => bcrypt('password')
        ]);

        $this->actingAs($admin);

        $response = $this->post('/users', [
            'name' => 'Тестовый Пользователь',
            'phone' => '1234567890',
            'email' => 'test@example.com',
        ]);

        $this->assertDatabaseHas('users', [
            'phone' => '1234567890',
            'email' => 'test@example.com',
        ]);
    }

    public function test_user_can_register_with_phone()
    {
        User::factory()->create([
            'phone' => '9876543210',
            'password' => bcrypt('temporary'),
            'is_registered' => false,
        ]);

        $response = $this->post('/register-phone', [
            'phone' => '9876543210',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);

        $user = User::where('phone', '9876543210')->first();

        $this->assertNotNull($user);
        $this->assertTrue(password_verify('secret123', $user->password));
        $this->assertEquals(1, $user->is_registered); // Исправлено: assertEquals вместо assertTrue
    }
}