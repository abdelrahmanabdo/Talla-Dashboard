<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
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
        'user_id',
        'session_type_id',
        'date',
        'time',
        'fees',
        'total_paid',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function stylist()
    {
        return $this->belongsTo(\App\Models\Stylist::class);
    }

    public function session()
    {
        return $this->belongsTo(\App\Models\StylistSpecialization::class, 'session_type_id');
    }    
}
