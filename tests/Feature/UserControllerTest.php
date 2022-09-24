<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    // php artisan test --filter UserControllerTest::testLogin
    public function testLogin()
    {
        $this->get('/login')
            ->assertSeeText('Login');
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            'user' => 'ridho',
            'password' => 'rahasia'
        ])->assertRedirect('/')
            ->assertSessionHas('user', 'ridho');
    }

    public function testLoginPageMember()
    {
        // bila ada sessionnya (udh login), lalu mencoba mengakses /login, akan di redirect ke /
        $this->withSession([
            'user' => 'ridho'
        ])->get('login')
            ->assertRedirect('/');
    }

    public function testLoginForUserAlreadyLogin()
    {
        // bila ada sessionnya (udh login), lalu mencoba mengakses /login, akan di redirect ke /
        $this->withSession([
            'user' => 'ridho'
        ])->post('/login', [
            'user' => 'ridho',
            'password' => 'rahasia'
        ])->assertRedirect('/');
    }

    public function testLoginValidationError()
    {
        $this->post('/login', [])
            ->assertSeeText('User or password is required.');
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            'user' => 'wrong',
            'password' => 'wrong'
        ])->assertSeeText('User or password wrong.');
    }

    public function testLogout()
    {
        $this->withSession([
            'user' => 'ridho'
        ])->post('/logout')
            ->assertRedirect('/')
            ->assertSessionMissing('user');
    }

    public function testLogoutGuest()
    {
        // bila belum login, tidak boleh melakukan logout
        $this->post('/logout')
            ->assertRedirect('/');
    }
}
