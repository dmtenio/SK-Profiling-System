<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name', 'first_name', 'middle_name', 'suffix', 'purok_id',
        'gender', 'age', 'dob', 'civil_status', 'email', 'mobile_num',
        'is_youth', 'is_living', 'youth_group', 'educational_background',
        'youth_classification', 'youth_specific_needs', 'work_status',
        'sk_voter', 'voted_last_sk', 'national_voter', 'attended_assembly',
        'attended_yes_how_many', 'attended_no_why', 'avatar', 'date_interviewed',
        'encoded_by'
    ];

    // Relationships
    public function purok()
    {
        return $this->belongsTo(Purok::class);
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function encodedBy()
    {
        return $this->belongsTo(User::class, 'encoded_by');
    }
    
}
