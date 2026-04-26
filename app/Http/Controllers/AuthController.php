<?php
namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\error;

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

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                "login" => "invalid credentials"
            ]);
        }

        if (Auth::user()->role('admin')) {
            return redirect("/kassa");
        } else if (Auth::user()->role('customer')) {
            return redirect("customer/chooseTable");
        }

        return abort(404, 'User type not allowed');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect("/login");
    }
}
