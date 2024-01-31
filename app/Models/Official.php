<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Official extends Model
{
    use HasFactory;

    protected $fillable = ['barangay_id', 'name', 'position_id', 'avatar'];

    // Relationships
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }
}
