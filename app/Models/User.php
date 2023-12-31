<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
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
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function items()
    {
        return $this->hasMany(Items::class);
    }
    public function memeber_incame()
    {
        return $this->hasMany(Memeber_incame::class);
    }
    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }
    public function carrency()
    {
        return $this->hasMany(Carrency::class);
    }
    public function region()
    {
        return $this->hasMany(Region::class);
    }
    public function target_limit()
    {
        return $this->hasMany(Target_limit::class);
    }
}
