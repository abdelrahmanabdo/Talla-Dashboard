<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'user_id',
      'show_working_hours',
      'show_in_stylists',
      'send_reservations',
      'send_before_reservations',
      'send_before_reservations_by',
    ];
}
