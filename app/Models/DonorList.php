<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount_of_donation'
    ];

    public function donation() { return $this->belongsTo(Donation::class, 'donation_id'); }
}
