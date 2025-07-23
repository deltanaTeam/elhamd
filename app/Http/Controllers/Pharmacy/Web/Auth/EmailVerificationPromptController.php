<?php

namespace App\Http\Controllers\Pharmacist\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        $user = Auth::guard('pharmacist')->user();

        return $user->hasVerifiedEmail()
            ? redirect()->intended(route('admin.dashboard'))
            : view('pharmacist.auth.verify-email');
    }
}
