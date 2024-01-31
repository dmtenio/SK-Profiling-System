<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purok extends Model
{
    use HasFactory;

    protected $fillable = ['barangay_id', 'name'];

    // Relationships
    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }
    
}
