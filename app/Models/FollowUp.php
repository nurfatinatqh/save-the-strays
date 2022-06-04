<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    use HasFactory;

    public $timestamps = false; 

    protected $fillable = [
        'health_condition',
        'picture',
        'follow_up_date'
    ];

    public function adopter() { return $this->belongsTo(User::class, 'adopter_id'); }

    public function volunteer() { return $this->belongsTo(User::class, 'volunteer_id'); }

    public function pet() { return $this->belongsTo(Pet::class, 'pet_id'); }

}
