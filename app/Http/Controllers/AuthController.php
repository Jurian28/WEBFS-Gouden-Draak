<?php
namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login() {
        if (Auth::check()) {
            return redirect('kassa');
        }
        return view('kassa.login');
    }


    function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'id' => 'required|integer',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect("/kassa");
        }

        return back()->withErrors([
            "login" => "failed bruv"
        ]);
    }

    function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect("/login");
    }
}
