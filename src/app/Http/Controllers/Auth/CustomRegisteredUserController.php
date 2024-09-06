<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CustomRegisteredUserController extends Controller
{
    public function store(Request $request, CreatesNewUsers $creator)
    {
        $user = $creator->create($request->all());

        Auth::login($user);

        return redirect()->route('thanks');
    }
}
