<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerCoverage extends Model
{
    use HasFactory;
    public $timestamps = false; 
    protected $fillable = [
        'street',
        'area',
        'district',
        'state',
    ];

    public function coverageArea() { return $this->belongsTo(User::class, 'volunteer_id'); }
}
