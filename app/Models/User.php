<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'role',
        'password',
        'address',
        'phone_number',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function volunteer () { return $this->hasMany('App\Models\Pet', 'volunteer_id'); }

    public function volunteer_FU () { return $this->hasMany('App\Models\FollowUp', 'volunteer_id'); }

    public function adopter () { return $this->hasMany('App\Models\Pet', 'adopter_id'); }

    public function adopter_FU () { return $this->hasMany('App\Models\FollowUp', 'adopter_id'); }

    public function coverageArea () { return $this->hasOne('App\Models\VolunteerCoverage', 'volunteer_id'); }

    public function donations () { return $this->hasMany('App\Models\Donation', 'volunteer_id'); }

}
