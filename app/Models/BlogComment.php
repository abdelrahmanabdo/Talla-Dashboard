<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $with = 'commenter';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  protected $fillable = [
      'blog_id',
      'commenter_id',
      'comment',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
      'id' => 'integer',
      'blog_id' => 'integer',
      'commenter_id' => 'integer',
    ];


    public function blog()
    {
      return $this->belongsTo(\App\Models\Blog::class);
    }

    public function commenter()
    {
      return $this->belongsTo(\App\Models\User::class);
    }
}
