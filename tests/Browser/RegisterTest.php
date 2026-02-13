<?php

use Illuminate\Support\Facades\Auth;

it('registers a user', function () {
    visit('/register')
        ->fill('name', 'Test User')
        ->fill('email', 'testuser@example.com')
        ->fill('password', 'password')
        ->click('Create Account')
        ->assertPathIs('/');

    $this->assertAuthenticated();

    expect(Auth::user())->toMatchArray([
        'name' => 'Test User',
        'email' => 'testuser@example.com'
    ]);
});

it('requires a valid email', function () {
    visit('/register')
        ->fill('name', 'Test User')
        ->fill('email', 'testuser')
        ->fill('password', 'password')
        ->click('Create Account')
        ->assertPathIs('/register');
});
