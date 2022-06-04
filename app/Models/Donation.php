<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_name',
        'health_condition',
        'phone_number',
        'email',
        'bank',
        'bank_no',
        'bank_owner_name',
        'expected_amount',
        'current_amount',
        'pet_picture',
        'vet_analysis',
        'status',
        'receipt',
        'updated_condition'
    ];

    public function donors () { return $this->hasMany('App\Models\DonorList', 'donation_id'); }

    public function volunteer() { return $this->belongsTo(User::class, 'volunteer_id'); }
}
