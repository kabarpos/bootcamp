<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        $message = trans('auth.verify_before_login');

        if ($request->wantsJson()) {
            return response()->json([
                'two_factor' => false,
                'verification_required' => $user instanceof MustVerifyEmail && ! $user->hasVerifiedEmail(),
                'message' => $message,
                'redirect_to' => route('login'),
            ], 201);
        }

        if ($user instanceof MustVerifyEmail && ! $user->hasVerifiedEmail()) {
            Auth::guard(config('fortify.guard', 'web'))->logout();

            return redirect()->route('login')->with('status', $message);
        }

        return redirect()->intended(config('fortify.home'));
    }
}
