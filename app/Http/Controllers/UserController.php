<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Services\UserService;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(): Response
    {
        return response()
            ->view("user.login", [
                "title" => "Login"
            ]);
    }

    public function doLogin(Request $request): Response|RedirectResponse
    {
        // ambil value setiap inputan
        $user = $request->input('user');
        $password = $request->input('password');

        // validate input
        if(empty($user) || empty($password)) {
            return response()->view('user.login', [
                'title' => 'Login',
                'error' => 'User or password is required.',
            ]);
        }

        // bila user dan password benar
        if($this->userService->login($user, $password)) {
            $request->session()->put("user", $user);
            return redirect('/');
        }

        // bila salah
        return response()->view('user.login', [
            'title' => 'Login',
            'error' => 'User or password wrong.',
        ]);
    }

    public function doLogout(Request $request): RedirectResponse
    {
        $request->session()->forget('user');
        return redirect('/');
    }
}
