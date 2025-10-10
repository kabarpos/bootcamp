<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class VerifyEmailController extends Controller
{
    public function __invoke(Request $request, int $id, string $hash)
    {
        if (! URL::hasValidSignature($request)) {
            return $this->invalidResponse();
        }

        $user = User::find($id);

        if (! $user || ! hash_equals($hash, sha1($user->email))) {
            return $this->invalidResponse();
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')
                ->with('status', trans('auth.verify_already'));
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->route('login')
            ->with('status', trans('auth.verify_success'));
    }

    private function invalidResponse()
    {
        return redirect()->route('login')
            ->withErrors(['email' => trans('auth.verify_invalid')]);
    }
}
