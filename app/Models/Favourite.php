<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
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
        'item_id',
        'type'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'closet_id' => 'integer',
    ];


    public function user()
    {
      return $this->belongsTo(\App\Models\User::class);
    }

    public function item()
    {
      return $this->belongsTo(\App\Models\Closet::class, 'item_id');
    }

    public function outfit()
    {
      return $this->belongsTo(\App\Models\Outfit::class, 'item_id');
    }
}
