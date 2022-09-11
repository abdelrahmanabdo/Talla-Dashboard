<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'chat_id',
        'user_id',
        'type',
        'message',
        'seen',
        'quotation_id'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
    
    public function quotation()
    {
        return $this->belongsTo(\App\Models\Quotation::class);
    }
}
