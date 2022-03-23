<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function __construct()
    {
        $this->middleware(['guest']);
    }
    
    public function index() {
        return view("auth.login");
    }

    public function store(Request $request) {
        $request->validate([
            "email" => "required|email|max:255",
            "password" => "required|min:6",
        ]);

        if (!auth()->attempt($request->only("email", "password"), $request->remember)) {
            return back()->with("status", "Invalid credentials");
        }

        return redirect()->route("dashboard");
    }
}
