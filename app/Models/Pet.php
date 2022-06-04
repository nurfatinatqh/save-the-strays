<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    public $timestamps = false; 

    protected $fillable = [
        'name',
        'type',
        'gender',
        'health_condition',
        'location',
        'state',
        'city',
        'phone_number',
        'pet_picture',
    ];

    public function adopter() { return $this->belongsTo(User::class, 'adopter_id'); }

    public function volunteer() { return $this->belongsTo(User::class, 'volunteer_id'); }

    public function followUp () { return $this->hasMany('App\Models\FollowUp', 'pet_id'); }

    protected $appends = ['volunteer'];

    public function getVolunteerAttribute() { $volunteer = User::find($this->volunteer_id); return $volunteer; }
}
