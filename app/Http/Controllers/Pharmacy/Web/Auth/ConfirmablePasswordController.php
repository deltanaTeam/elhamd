<?php

<?php

namespace App\Http\Controllers\Pharmacist\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     */
    public function show(): View
    {
        return view('pharmacist.auth.confirm-password'); // تأكدي من وجود هذا الملف
    }

    /**
     * Confirm the pharmacist's password.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = Auth::guard('pharmacist')->user();

        if (! Auth::guard('pharmacist')->validate([
            'email' => $user->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.pharmacist.password_confirmed_at', time());

        return redirect()->intended(route('admin.dashboard'));
    }
}
