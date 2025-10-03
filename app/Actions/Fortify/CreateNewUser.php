<?php

namespace App\Actions\Fortify;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
}
