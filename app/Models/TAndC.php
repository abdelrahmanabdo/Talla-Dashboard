<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TAndC extends Model
{
  use \Backpack\CRUD\app\Models\Traits\CrudTrait;
  use HasFactory;

  protected $table = 'T&C';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text',
        'text_ar',
    ];
}
