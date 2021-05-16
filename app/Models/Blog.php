<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    // protected $with = ['user'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'title_ar',
        'body',
        'body_ar',
        'likes',
        'hashtags',
        'is_reviewed',
        'is_featured',
        'active',
        'published_at',
        'softDeletes',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'hashtags' => 'array',
        'is_reviewed' => 'boolean',
        'active' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'published_at',
    ];


    /**
     * Blog owner
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Blog comments
     */
    public function comments()
    {
        return $this->hasMany(\App\Models\BlogComment::class);
    }

    /**
     * Blog reviews
     */
    public function reviews()
    {
        return $this->hasMany(\App\Models\BlogReview::class);
    }

    /**
     * Blog images
     */
    public function images()
    {
        return $this->hasMany(\App\Models\BlogImage::class);
    }

    /**
     * Blog images
     */
    public function image()
    {
        return $this->hasOne(\App\Models\BlogImage::class);
    }

    public function acceptBlogButton()
    {
        return '<a class="btn btn-xs btn-default" href="accept" data-toggle="tooltip" title="Just a demo custom button.">Accept</a>';
    }

    public function rejectBlogButton()
    {
        return '<a class="btn btn-4 btn-danger" href="reject" data-toggle="tooltip" title="Just a demo custom button.">Reject</a>';
    }
}
