<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image as Image;
class BlogImage extends Model
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
        'type',
        'image',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'blog_id' => 'integer',
    ];


    public function blog()
    {
        return $this->belongsTo(\App\Models\Blog::class);
    }



    /**
     * Save image
     */
    public function save_image ($image_str) {
        $attribute_name = "image";
        // or use your own disk, defined in config/filesystems.php
        $disk = config( 'filesystems.disks.public.driver'); 
        // destination path relative to the disk above
        $destination_path = "public/images/blogs/"; 

        // 0. Make the image
        $image = \Image::make($image_str)->encode('png', 90);
        // 1. Generate a filename.
        $filename = $this->attributes['blog_id'].'_'. date('Y-M') .'.png';
        // 2. Store the image on disk.
        \Storage::disk($disk)->put($destination_path . $filename, $image->stream());
        // 3. Delete the previous image, if there was one.
        \Storage::disk($disk)->delete($this->{$attribute_name});
        // 4. Save the public path to the database
        // but first, remove "public/" from the path, since we're pointing to it 
        $public_destination_path = Str::replaceFirst('public', 'storage', $destination_path);
        $this->attributes[$attribute_name] = url('/') . '/' . $public_destination_path . $filename;
    }

    public function setImageAttribute($value)
    { 
      if (gettype($value) == 'array'){
        foreach ($value as $image) {
          // if a base64 was sent, store it in the db
          $this->save_image($image);
        }
      }
    }
}
