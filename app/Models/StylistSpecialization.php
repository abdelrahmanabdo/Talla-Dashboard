<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StylistSpecialization extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    protected $with = ['specialization'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stylist_id',
        'specialization_id',
        'description',
        'start_price',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'stylist_id' => 'integer',
        'specialization_id' => 'integer',
    ];


    public function stylist()
    {
        return $this->belongsTo(\App\Models\Stylist::class);
    }

    public function specialization()
    {
        return $this->belongsTo(\App\Models\Specialization::class)->select(['id','title']);
    }
}
