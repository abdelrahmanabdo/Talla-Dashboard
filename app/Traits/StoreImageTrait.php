<?php
 
namespace App\Traits;
 
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Storage;

trait StoreImageTrait {
 
    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */
    public function verifyAndStoreBase64Image($base64Str, $fileName = '', $directory = 'unknown') {
        // Check if there is base64 string is sent
        if (!$base64Str) return null;

        // Public project disk
        $disk = config('filesystems.disks.public.driver'); 

        // destination path relative to the disk above
        $destination_path = "public/images/". $directory; 

        // if a base64 was sent, store it in the db
        if (Str::startsWith($base64Str, 'data:image')) {
            // 0. Make the image
            $image = Image::make($base64Str)->encode('png', 90);
            // 1. Generate a filename.
            //if filename contains spaces
            if (Str::contains($fileName, ' ')) $fileName = Str::camel($fileName);
            $filename = $fileName . '_' . time() . '_' .  date('d-M-Y') .'.png';
            // 2. Store the image on disk.
            Storage::disk($disk)->put($destination_path . '/' . $filename, $image->stream());
            // 3. Delete the previous image, if there was one.
            Storage::disk($disk)->delete($fileName);
            // 4. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it 
            $public_destination_path = Str::replaceFirst('public', 'storage', $destination_path);

            return url('') . '/' . $public_destination_path . '/' . $filename;
        }

        return null;
    }

    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */
    public function verifyAndStoreImage( $image, $fileName = '', $directory = 'unknown') {
        // Check if there is base64 string is sent
        if (!$image) return null;

        // Public project disk
        $disk = config('filesystems.disks.public.driver'); 

        // destination path relative to the disk above
        $destination_path = "public/images/". $directory; 

        // 0. Make the image
        $image = Image::make($image);
        // 1. Generate a filename.
        //if filename contains spaces
        if (Str::contains($fileName, ' ')) $fileName = Str::camel($fileName);
        $filename = $fileName . '_' . time() . '_' . date('d-M-Y') . '.' .substr($image->mime(), 6);
        // 2. Store the image on disk.
        Storage::disk($disk)->put($destination_path . '/' . $filename, $image->stream());
        // 3. Delete the previous image, if there was one.
        Storage::disk($disk)->delete($fileName);
        // 4. Save the public path to the database
        // but first, remove "public/" from the path, since we're pointing to it 
        $public_destination_path = Str::replaceFirst('public', 'storage', $destination_path);

        return url('') . '/' . $public_destination_path . '/' . $filename;
    }
 
}