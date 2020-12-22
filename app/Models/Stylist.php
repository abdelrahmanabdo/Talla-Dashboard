<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stylist extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'avatar',
        'email',
        'mobile_numbers',
        'country_id',
        'bio',
        'experience_years',
        'is_approved',
        'active',
        'softDeletes',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'country_id' => 'integer',
        'mobile_numbers' => 'array',
        'is_approved' => 'boolean',
        'active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class);
    }

    public function certificates()
    {
        return $this->hasMany(\App\Models\StylistCertificate::class);
    }

    public function projects()
    {
        return $this->hasMany(\App\Models\StylistProject::class);
    }

    public function specializations()
    {
        return $this->hasMany(\App\Models\StylistSpecialization::class);
    }

}
