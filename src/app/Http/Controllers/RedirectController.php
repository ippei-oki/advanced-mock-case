<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirectUser()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect('/admin');
        } elseif ($user->role === 'store_representative') {
            return redirect('/store');
        } else {
            return redirect('/');
        }
    }
}
