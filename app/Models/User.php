<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use App\Models\PostsModell;
class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'user_profile_image',
        'phone',
        'country',
        'country_code',
        'email',
        'password',
        'description'
    ];

    public function posts()
    {
        return $this->hasMany(PostsModell::class);
    }

    public function images()
    {
        return $this->hasMany(PostsImagesModell::class);
    }

    public function comments()
    {
        return $this->hasMany(comments::class);
    }
    public function ask()
    {
        return $this->hasMany(ask::class);
    }

    public function comms()
    {
        return $this->hasMany(askComments::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
