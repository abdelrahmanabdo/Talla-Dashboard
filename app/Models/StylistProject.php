<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StylistProject extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    protected $with = ['images'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stylist_id',
        'name',
        'description',
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
    
    public function images()
    {
        return $this->hasMany(\App\Models\StylistProjectImage::class,'project_id');
    }

    public function image()
    {
        return $this->hasOne(\App\Models\StylistProjectImage::class,'project_id');
    }

    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        // or use your own disk, defined in config/filesystems.php
        $disk = config('filesystems.disks.public.driver'); 
        // destination path relative to the disk above
        $destination_path = "public/images/projects/"; 

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image'))
        {
            // 0. Make the image
            $image = \Image::make($value)->encode('png', 90);

            // 1. Generate a filename.
            $filename = $this->attributes['project_name'].'_'. date('Y-M') .'.png';

            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path . $filename, $image->stream());

            // 3. Delete the previous image, if there was one.
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // 4. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it 
            $public_destination_path = Str::replaceFirst('public', 'storage', $destination_path);
            $this->attributes[$attribute_name] = url('/') . '/' . $public_destination_path . $filename;
        }
    }
}
