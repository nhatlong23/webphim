<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'customers';
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'facebook_id',
        'emailed_movies',
        'token',
        'expires_at',
        'locked',
        'verified'
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
        'email_verified_at' => 'datetime',
        'emailed_movies' => 'json',
    ];

    public function isSocialLogin()
    {
        return !empty($this->facebook_id) || !empty($this->google_id);
    }

    public function movies()
    {
        if (!empty($this->emailed_movies)) {
            return Movie::whereIn('id', $this->emailed_movies)->pluck('title')->toArray();
        }

        return [];
    }
}
