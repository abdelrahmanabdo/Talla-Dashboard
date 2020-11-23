<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
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
        'body_shaped_id',
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
        'body_shaped_id' => 'integer',
        'skin_glow_id' => 'integer',
        'job_id' => 'integer',
        'goal_id' => 'integer',
        'favourite_style_id' => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function bodyShaped()
    {
        return $this->belongsTo(\App\Models\RegistrationChoices::class);
    }

    public function skinGlow()
    {
        return $this->belongsTo(\App\Models\RegistrationChoices::class);
    }

    public function job()
    {
        return $this->belongsTo(\App\Models\RegistrationChoices::class);
    }

    public function goal()
    {
        return $this->belongsTo(\App\Models\RegistrationChoices::class);
    }

    public function favouriteStyle()
    {
        return $this->belongsTo(\App\Models\RegistrationChoices::class);
    }
}
