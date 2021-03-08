<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chat extends Model
{
    use HasFactory;

    // protected $with = ['user'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_1',
        'user_2',
        'chat_ref',
        'active',
    ];

    /**
     * User 1
     */
    public function first()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_1');
    }

    /**
     * User 2
     */
    public function second()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_2');
    }
}
