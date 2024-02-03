<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'position_id', 'barangay_id', 'access_type', 'status', 'avatar',
        'email', 'password'
    ];

    // Relationships
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function officials()
    {
        return $this->hasMany(Official::class);
    }

    public function residents()
    {
        return $this->hasMany(Resident::class, 'encoded_by');
    }

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
    ];
}
