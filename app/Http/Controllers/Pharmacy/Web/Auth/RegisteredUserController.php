<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pharmacist;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredPharmacistController extends Controller
{
    /**
     * Show the pharmacist registration form.
     */
    public function create(): View
    {
        return view('pharmacist.auth.register');
    }

    /**
     * Handle a pharmacist registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:pharmacists,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $pharmacist = Pharmacist::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($pharmacist));

        Auth::guard('pharmacist')->login($pharmacist);

        return redirect()->intended(route('pharmacist.dashboard'));
    }
}
