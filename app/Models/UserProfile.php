<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
    use HasFactory;

    protected $table = 'user_profile';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'phone',
        'country_id',
        'city_id',
        'avatar',
        'birth_date',
        'body_shape_id',
        'skin_glow_id',
        'job_id',
        'goal_id',
        'favourite_style_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'body_shape_id' => 'integer',
        'skin_glow_id' => 'integer',
        'job_id' => 'array',
        'goal_id' => 'array',
        'favourite_style_id' => 'array',
    ];


    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class);
    }

    public function city()
    {
        return $this->belongsTo(\App\Models\Country::class);
    }

    public function bodyShape()
    {
        return $this->belongsTo(\App\Models\RegistrationChoice::class);
    }

    public function skinGlow()
    {
        return $this->belongsTo(\App\Models\RegistrationChoice::class);
    }

    public function jobs()
    {
        return $this->belongsTo(\App\Models\RegistrationChoice::class);
    }

    public function goals()
    {
        return $this->belongsTo(\App\Models\RegistrationChoice::class);
    }

    public function favouriteStyles()
    {
        return $this->belongsTo(\App\Models\RegistrationChoice::class);
    }
}
