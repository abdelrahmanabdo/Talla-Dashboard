<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class Settings extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'site_title',
        'address',
        'phone_number',
        'address',
        'logo',
        'email',
        'facebook_url',
        'twitter_url',
        'linkedIn_url',
        'google_url',
        'instagram_url',
        'tiktok_url',
    ];


    public function setLogoAttribute($value)
    {
        $attribute_name = "logo";
        // or use your own disk, defined in config/filesystems.php
        $disk = config('filesystems.disks.public.driver'); 
        // destination path relative to the disk above
        $destination_path = "public/images/settings/"; 

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image'))
        {
            // 0. Make the image
            $image = \Image::make($value)->encode('png', 90);

            // 1. Generate a filename.
            $filename = 'logo_'. date('Y-M') .'.png';

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
