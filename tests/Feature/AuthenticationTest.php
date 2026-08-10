<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('user bisa registrasi dengan data valid', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertRedirect(route('home'));
    $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    $this->assertAuthenticated();
});

it('registrasi gagal jika email sudah terdaftar', function () {
    User::factory()->create(['email' => 'sudah@ada.com']);

    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'sudah@ada.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertSessionHasErrors('email');
});

it('user bisa login dengan kredensial benar', function () {
    $user = User::factory()->create(['password' => 'password123']);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password123',
    ]);

    $response->assertRedirect(route('home'));
    $this->assertAuthenticatedAs($user);
});

it('login gagal dengan password salah', function () {
    $user = User::factory()->create(['password' => 'password123']);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'salah',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});