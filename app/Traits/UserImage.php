<?php

namespace App\Traits;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait UserImage
{
    public function store(string $folder, int $width, int $height,$file): string | null
    {
        //dd($file);
        $fileNameToStore = null;
        if (request()->hasFile($file))
        {
            $image = request()->file($file);
            //dd($image);
            $ext = $image->getClientOriginalExtension();
            $filename = rand(1, 10000) . time() . Str::lower(Str::random());
            $fileNameToStore = $filename.'.'.$ext;
            $image->storeAs($folder, $fileNameToStore, 'public');
            Image::make($image)->resize($width, $height, static function ($constraint){
                $constraint->aspectRatio();
            })->save(public_path("storage/{$folder}/".$fileNameToStore));
        }
        return $fileNameToStore;
    }
    public function storeMultiple(string $folder, int $width, int $height,$file): bool|string|null
    {
        $fileNameToSave = [];
        if (request()->hasFile($file))
        {
            $photos = request()->file($file);
            foreach ($photos as $photo){
                $ext = $photo->getClientOriginalExtension();
                $filename = rand(1, 10000) . time() . Str::lower(Str::random());
                $fileNameToStore = "$filename.$ext";
                $fileNameToSave[] = $fileNameToStore;
                $file->storeAs($folder, $fileNameToStore, 'public');
                Image::make($file)->resize($width, $height, static function ($constraint){
                    $constraint->aspectRatio();
                })->save(public_path("storage/$folder/".$fileNameToStore));
            }
        }
        if (sizeof($fileNameToSave) == 0) {
            //no file was uploaded
            return null;
        }
        return json_encode($fileNameToSave);
    }
}
