<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
class Category extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'name_en',
        'icon',
        'icon_colored',
        'active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'active' => 'boolean',
    ];

    public function setIconAttribute($value)
    {
        $attribute_name = "icon";
        // or use your own disk, defined in config/filesystems.php
        $disk = config('filesystems.disks.public.driver'); 
        // destination path relative to the disk above
        $destination_path = "public/images/categories/"; 

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image'))
        {
            // 0. Make the image
            $image = \Image::make($value)->encode('png', 90);

            // 1. Generate a filename.
            $filename = $this->attributes['name_en'].'_'. date('Y-M') .'.png';

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

    public function setIconColoredAttribute($value)
    {
        $attribute_name = "icon_colored";
        // or use your own disk, defined in config/filesystems.php
        $disk = config('filesystems.disks.public.driver'); 
        // destination path relative to the disk above
        $destination_path = "public/images/categories/"; 

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image'))
        {
            // 0. Make the image
            $image = \Image::make($value)->encode('png', 90);

            // 1. Generate a filename.
            $filename = $this->attributes['name_en'].'_colored_'. date('Y-M') .'.png';

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
