<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogReview extends Model
{
  use \Backpack\CRUD\app\Models\Traits\CrudTrait;

  use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  protected $fillable = [
    'blog_id',
    'name',
    'email',
    'website',
    'comment',
  ];


  public function blog()
  {
    return $this->belongsTo(\App\Models\Blog::class);
  }

}
