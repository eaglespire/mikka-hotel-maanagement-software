<?php

namespace App\Traits;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

trait CloudinaryFileServer
{

    /**
     * @throws \Exception
     */
    public function SaveFile(string $folder, int $width, int $height, string $filename, $format = 'jpg'): array |null | bool
    {
        try {
            if (request()->hasFile($filename)){
                try {
                    $apiResponse =  Cloudinary::uploadApi()->upload(request()->file($filename)->getRealPath(), [
                        'folder'=>$folder,
                        'format'=>$format,
                        'transformation'=>[
                            'width'=>$width,
                            'height'=>$height,
                            'crop'=>'fill'
                        ]
                    ]);
                    //decode the api response
                    $response = json_decode(json_encode($apiResponse),true);
                    return [ $response['public_id'], $response['secure_url'] ];
                }  catch (RequestException $exception){
                    Log::error($exception->getMessage());
                    return null;
                }
            } else{
                return null;
            }
        }  catch (RequestException $exception){
            Log::error($exception->getMessage());
            return null;
        }

      }

    /**
     * @throws \Exception
     */
    public function DeleteFile(mixed $publicId) : string | bool
      {
          if (empty($publicId)){
             return false;
          }
          $response = Cloudinary::uploadApi()->destroy($publicId);
          if (!$response){
              //throw  new \Exception('An error has occurred');
              return false;
          } else{
              return true;
          }
      }

    /**
     * @throws \Exception
     */
    public function CheckImageWasUploaded($filename, $publicId,$folder,int $width,int $height): array | bool  | null
    {
        if (!empty($filename) && request()->hasFile($filename)){
            //check to see if public_id exists
            if (!empty($publicId)){
                //delete the previous image
                $res = $this->DeleteFile($publicId);
                if (!$res){
                    return null;
                }
            }
            //and upload a new one
            return $this->SaveFile($folder,$width,$height,$filename);    //returns an array
        }else{
            return null;
        }
      }
    public function LivewireCheckImageWasUploaded($filename, $publicId,$folder,int $width,int $height): array | bool  | null
    {
            //check to see if public_id exists
            if (!empty($publicId)){
                //delete the previous image
                $res = $this->DeleteFile($publicId);
                if (!$res){
                    return null;
                }
            }
            //and upload a new one
            return $this->SaveFile($folder,$width,$height,$filename);    //returns an array
    }

}
