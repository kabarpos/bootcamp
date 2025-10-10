<?php

namespace App\Actions\Fortify;

use App\Models\Role;
use App\Models\User;
use App\Services\WhatsappNotificationService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'whatsapp_number' => ['required', 'string', 'min:8', 'max:20', 'regex:/^[0-9+\s()-]+$/'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $normalizedWhatsapp = $this->normalizeWhatsappNumber($input['whatsapp_number']);

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'whatsapp_number' => $normalizedWhatsapp,
            'password' => Hash::make($input['password']),
        ]);

        $defaultRole = Role::firstOrCreate(
            ['name' => 'user'],
            ['guard_name' => 'web']
        );

        $user->roles()->syncWithoutDetaching([$defaultRole->id]);

        $this->sendWhatsappVerification($user);
        $user->sendEmailVerificationNotification();

        return $user;
    }

    private function normalizeWhatsappNumber(string $value): string
    {
        $normalized = preg_replace('/[\s\-()]/', '', trim($value));

        if (str_starts_with($normalized, '00')) {
            $normalized = '+' . substr($normalized, 2);
        }

        return $normalized;
    }

    private function sendWhatsappVerification(User $user): void
    {
        $service = app(WhatsappNotificationService::class);

        if (! $service->enabled()) {
            return;
        }

        if (! $user->whatsapp_number) {
            return;
        }

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes((int) config('auth.verification.expire', 60)),
            ['id' => $user->getKey(), 'hash' => sha1($user->email)]
        );

        $expiresIn = config('auth.verification.expire', 60) . ' menit';

        $service->sendTemplate('registration_verification', $user->whatsapp_number, [
            'name' => $user->name,
            'app_name' => config('app.name'),
            'verification_link' => $verificationUrl,
            'expires_in' => $expiresIn,
        ]);
    }
}
