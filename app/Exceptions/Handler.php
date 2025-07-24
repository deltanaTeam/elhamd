<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * تحديد الحقول اللي مش هتتخزن في الـ log
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * تسجلي الـ exception (افتراضيًا مفيش حاجة هنا).
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * تخصيص redirect حسب الجارد لما المستخدم مش يكون مسجل دخول
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        $guard = $exception->guards()[0] ?? 'web';

        switch ($guard) {
            case 'pharmacist':
                $login = route('pharmacist.login');
                break;

            case 'web-owner':
                $login = route('web-owner.login');
                break;
            // case 'client':
            //     $login = route('client.login');
            //     break;

            default:
                $login = route('login'); /
                break;
        }

        return $request->expectsJson()
            ? response()->json(['message' => 'Unauthenticated.'], 401)
            : redirect()->guest($login);
    }
}
