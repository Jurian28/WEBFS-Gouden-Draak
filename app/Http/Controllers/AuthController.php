<?php
namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
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
}
