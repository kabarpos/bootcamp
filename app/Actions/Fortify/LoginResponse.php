<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        if ($request->wantsJson()) {
            return response()->json(['two_factor' => false]);
        }

        $redirectTo = match (true) {
            $user && method_exists($user, 'isAdmin') && $user->isAdmin() => route('admin.dashboard'),
            default => route('public.dashboard'),
        };

        return redirect()->intended($redirectTo);
    }
}
