<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;

    protected $fillable = ['municipality_id', 'name'];

    // Relationships
    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function puroks()
    {
        return $this->hasMany(Purok::class);
    }

    public function officials()
    {
        return $this->hasMany(Official::class);
    }

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }
}
