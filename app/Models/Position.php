<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relationships
    public function officials()
    {
        return $this->hasMany(Official::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
}
