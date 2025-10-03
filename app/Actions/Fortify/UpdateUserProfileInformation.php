<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'whatsapp_number' => ['required', 'string', 'min:8', 'max:20', 'regex:/^[0-9+\s()-]+$/'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        $normalizedWhatsapp = $this->normalizeWhatsappNumber($input['whatsapp_number'] ?? '');

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, array_merge($input, [
                'whatsapp_number' => $normalizedWhatsapp,
            ]));
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'whatsapp_number' => $normalizedWhatsapp,
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'whatsapp_number' => $this->normalizeWhatsappNumber($input['whatsapp_number'] ?? ''),
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }

    private function normalizeWhatsappNumber(string $value): string
    {
        $normalized = preg_replace('/[\s\-()]/', '', trim($value));

        if (! empty($normalized) && str_starts_with($normalized, '00')) {
            $normalized = '+' . substr($normalized, 2);
        }

        return $normalized;
    }
}
