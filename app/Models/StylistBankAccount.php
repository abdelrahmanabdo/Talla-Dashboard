<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StylistBankAccount extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stylist_id',
        'name_on_card',
        'card_number',
        'expire_date',
        'CVV',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'stylist_id' => 'integer',
    ];


    public function stylist()
    {
        return $this->belongsTo(\App\Models\Stylist::class);
    }
}
