<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClosetOutfitItem extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    
    protected $with = ['closetItem'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'outfit_id',
        'closet_item_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'outfit_id' => 'integer',
        'closet_item_id' => 'integer',
    ];


    public function outfit()
    {
        return $this->belongsTo(\App\Models\Outfit::class);
    }

    public function closetItem()
    {
        return $this->belongsTo(\App\Models\Closet::class);
    }
}
