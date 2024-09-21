<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', Rule::unique(User::class)],
            'password' => $this->passwordRules(),
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('verification.notice');
    }

    protected function passwordRules()
    {
        return ['required', 'string', 'min:8', 'max:191'];
    }
}
