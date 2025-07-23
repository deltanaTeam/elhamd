<?php
namespace App\Http\Controllers\Pharmacist\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('pharmacist.auth.login'); // لو عندك مجلد login خاص بالصيدلي
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate('pharmacist'); // لو `LoginRequest` يدعم تعدد الـ guards

        $request->session()->regenerate();

        return redirect()->intended(route('pharmacist.dashboard')); // أو أي Route للصيدلي
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('pharmacist')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('pharmacist.login');
    }
}
