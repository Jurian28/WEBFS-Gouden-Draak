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
            return $this->sendLoggedInUserToView();
        }
        return view('employee.login');
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

        return $this->sendLoggedInUserToView();
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect("/login");
    }

    private function sendLoggedInUserToView() {
        if (Auth::user()->role('employee')) {
            return redirect("/employee");
        } else if (Auth::user()->role('customer')) {
            return redirect("customer/chooseTable");
        } else if (Auth::user()->role('admin')) {
            return redirect()->route("admin.dishes.index");
        }

        return abort(404, 'User type not allowed');
    }
}
