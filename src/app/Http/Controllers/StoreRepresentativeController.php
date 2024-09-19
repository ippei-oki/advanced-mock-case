<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreRepresentativeController extends Controller
{
    public function create()
    {
        return view('admin.store-representatives.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:8|max:191',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'store_representative',
        ]);

        return redirect()->route('store-representatives.index');
    }

}
