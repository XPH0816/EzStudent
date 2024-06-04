<?php

namespace App\Models;

use App\Enums\AdminRoleEnum;
use App\Notifications\AdminVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Interfaces\MustChangePassword as MustChangePasswordInterface;
use App\Traits\MustChangePassword;

class Admin extends Authenticatable implements MustVerifyEmail, MustChangePasswordInterface
{
    use HasFactory, Notifiable, MustChangePassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'image',
        'username',
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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'role_id' => AdminRoleEnum::class,
        'password' => 'hashed',
    ];

    public function isSuperAdmin(): bool
    {
        return $this->role_id == AdminRoleEnum::SUPER_ADMIN;
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => Str::startsWith($value, 'http') || Str::startsWith($value, '/') ? $value : Storage::url($value),
        );
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new AdminVerifyEmail);
    }
}
