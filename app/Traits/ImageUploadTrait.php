<?php

namespace App\Traits;

use File;
use FFMpeg;
use Illuminate\Support\Facades\Storage;
trait ImageUploadTrait
{
    public static function uploadImage($file, $path)
    {
        try {
            // Generate a unique filename

            $filename = time() . '_' . str_replace(' ', '', $file->getClientOriginalName());
            $path = 'uploads/' . $path . '/' . $filename;
            $new_file_path = $path . $filename;
            Storage::disk('public')->put($new_file_path, file_get_contents($file));

            return $filename;
            // return $path;
        } catch (\Exception $ex) {
            // Dump the exception for debugging
            dd($ex);

            return $ex->getMessage();
        }
    }

    public static function updateImage($old_file_name, $file, $path)
    {
        try {
            $path = 'uploads/' . $path . '/';
            $old_file_path = $path . $old_file_name;
            if (Storage::disk('public')->exists($old_file_path)) {
                Storage::disk('public')->delete($old_file_path);
            }
            $filename = time() . '_' . str_replace(' ', '', $file->getClientOriginalName());
            $new_file_path = $path . $filename;
            Storage::disk('public')->put($new_file_path, file_get_contents($file));
            return $filename;
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            \Session::flash('error', 'Error - Something Went Wrong..');
            return null;
        }
    }

    public static function removeImage($filename, $path)
    {
        $destinationPath = 'uploads/' . $path . '/';
        $filename = $destinationPath . '/' . $filename;

        if (file_exists($filename)) {
            Storage::disk('public')->delete($filename);
        }

        return true;
    }

    public static function uploadMedia($id, $file, $path)
    {
        try {
            $ext = $file->getClientOriginalExtension();

            // if($ext=="mp4" || $ext =="mkv" || $ext =="avi"){

            // 	$filename = $id."-".time().".mp4";

            // }else{

            $filename = $id . '-' . time() . '.' . $ext;

            // }

            $path = $path . '/' . $filename;

            $disk = \Storage::disk('media')->put($path, fopen($file, 'r+'));

            return $filename;
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());

            \Session::flash('error', 'Error - Something Went Wrong..');

            // return redirect()->back();
        }
    }

    public static function removeMedia($filename, $path)
    {
        \Storage::disk('public')->delete($path . '/' . $filename);

        // unlink(public_path('assets/uploads/'.$path.'/'.$filename));

        return true;
    }

    public static function UploadMediaIntoStorage($file, $path)
    {
        return 'storage/' . $file->store($path, 'public');
    }

    public static function GenerateThumbnail($videoPath, $thumbnailPath, $time = 2)
    {
        $thumbnailFilename = 'thumbnail_' . time() . '.jpg';

        $thumbnailPath = $thumbnailPath . $thumbnailFilename;

        FFMpeg::fromDisk('public')

            ->open($videoPath)

            ->getFrameFromSeconds($time)

            ->export()

            ->toDisk('public')

            ->save($thumbnailPath);

        return 'storage/' . $thumbnailPath;
    }
}
