<?php

namespace App\Models;

use App\Services\EmailNotificationService;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'whatsapp_number',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function setWhatsappNumberAttribute($value): void
    {
        if ($value === null) {
            $this->attributes['whatsapp_number'] = null;
            return;
        }

        $normalized = preg_replace('/[\s\-()]/', '', trim($value));

        if ($normalized !== '' && str_starts_with($normalized, '00')) {
            $normalized = '+' . substr($normalized, 2);
        }

        $this->attributes['whatsapp_number'] = $normalized !== '' ? $normalized : null;
    }


    /**
     * Get the enrollments for the user.
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Get the certificates for the user through enrollments.
     */
    public function certificates()
    {
        return $this->hasManyThrough(Certificate::class, Enrollment::class);
    }

    /**
     * Get the orders through enrollments.
     */
    public function orders()
    {
        return $this->hasManyThrough(Order::class, Enrollment::class);
    }

    /**
     * Get the roles for the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    /**
     * Check if user has a specific role.
     */
    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    /**
     * Check if user is admin.
     */
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function sendEmailVerificationNotification(): void
    {
        $service = app(EmailNotificationService::class);

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            ['id' => $this->getKey(), 'hash' => sha1($this->email)]
        );

        $sent = $service->sendTemplate('registration_verification', $this->email, [
            'name' => $this->name,
            'app_name' => config('app.name'),
            'verification_link' => $verificationUrl,
            'expires_in' => Config::get('auth.verification.expire', 60) . ' menit',
        ]);

        if (! $sent) {
            $this->notify(new VerifyEmail);
        }
    }

    public function sendPasswordResetNotification($token): void
    {
        $service = app(EmailNotificationService::class);

        $resetUrl = url(route('password.reset', [
            'token' => $token,
            'email' => $this->email,
        ], false));

        $sent = $service->sendTemplate('password_reset', $this->email, [
            'name' => $this->name,
            'app_name' => config('app.name'),
            'reset_link' => $resetUrl,
            'expires_in' => Config::get('auth.passwords.' . Config::get('auth.defaults.passwords') . '.expire', 60) . ' menit',
        ]);

        if (! $sent) {
            $this->notify(new ResetPassword($token));
        }
    }
}
