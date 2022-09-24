<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\UserService;

class UserServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);
    }

    public function testSample()
    {
        self::assertTrue(true);
    }

    public function testLoginSuccess()
    {
        self::assertTrue($this->userService->login("ridho", "rahasia"));
    }

    public function testLoginNotFound()
    {
        self::assertFalse($this->userService->login("toni", "toni"));
    }

    public function testLoginWrongPassword()
    {
        self::assertFalse($this->userService->login("ridho", "salah"));
    }
}
