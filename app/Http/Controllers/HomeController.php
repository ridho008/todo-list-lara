<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    public function home(Request $request): RedirectResponse
    {
        // bila sudah login
        if($request->session()->exists('user')) {
            return redirect('/todolist');
        } else {
            // bila belum login
            return redirect('/login');
        }
    }
}
