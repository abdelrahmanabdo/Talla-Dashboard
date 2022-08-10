<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outfit extends Model
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
      'group',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
      'id' => 'integer',
      'user_id' => 'integer',
      'group' => 'integer',
    ];


    public function user()
    {
      return $this->belongsTo(\App\Models\User::class);
    }


    public function items()
    {
      return $this->hasMany(\App\Models\ClosetOutfitItem::class, 'outfit_id');
    }

}
