<?php

namespace App\Traits;
use Illuminate\Http\Request;
use File;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;

trait imageUploadsTrait{



    public function imageUpload(Request $request, $inputName, $path){
        if($request->hasFile($inputName)){
            // $image = $request->{$inputName};
            // $ext = $image->getClientOriginalExtension();
            // $imageName = 'media_'.uniqid().'.'.$ext;
            // $image->store($path, 's3')
            // $image->move(public_path($path), $imageName);
            $imagepath = $request->file($inputName)->store($path, 's3');
            Storage::disk('s3')->setVisibility($imagepath, 'public');
            // dd($path);
            $urls = Storage::disk('s3')->url($path);

            return $urls;
        }
    }

    public function imageUpdate(Request $request, $inputName, $path, $oldPath=null){

        $s3Client = new \Aws\S3\S3Client([
            'version' => 'latest',
            'region' => getenv('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key' => getenv('AWS_ACCESS_KEY_ID'),
                'secret' => getenv('AWS_SECRET_ACCESS_KEY')
            ]
        ]);


        $response = $s3Client->doesObjectExist(getenv('AWS_BUCKET'),$oldPath);
        if ($response) {
            $s3Client->delete($oldPath);
        }
        $image = $request->{$inputName};
        $imagepath = $image->store($path, 's3');
        Storage::disk('s3')->setVisibility($imagepath, 'public');
        $url = Storage::disk('s3')->url($imagepath);
        return $url;
        // if($request->hasFile($inputName)){
        //     if(File::exists(public_path($oldPath)))
        //     {
        //         File::delete(public_path($oldPath));
        //     }
        //     $image = $request->{$inputName};
        //     $ext = $image->getClientOriginalExtension();
        //     $imageName = 'media_'.uniqid().'.'.$ext;
        //     $image->move(public_path($path), $imageName);
        //     return $path.'/'.$imageName;
        // }
    }

    public function imageDelete($path){
        $s3Client = new \Aws\S3\S3Client([
            'version' => 'latest',
            'region' => getenv('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key' => getenv('AWS_ACCESS_KEY_ID'),
                'secret' => getenv('AWS_SECRET_ACCESS_KEY')
            ]
        ]);


        $response = $s3Client->doesObjectExist(getenv('AWS_BUCKET'),$path);

        if ($response) {
            $s3Client->delete($path);
        }
    }

    public function imageUploadMultiple(Request $request, $inputName, $path){
        $paths = [];
        if($request->hasFile($inputName)){
            $images = $request->{$inputName};

            foreach($images as $image){
                // $ext = $image->getClientOriginalExtension();
                // $imageName = 'media_'.uniqid().'.'.$ext;
                // $image->move(public_path($path), $imageName);
                // $paths[] =  $path.'/'.$imageName;
                $imagepath = $image->store($path, 's3');
                Storage::disk('s3')->setVisibility($imagepath, 'public');
                // dd($imagepath);
                $paths[] = Storage::disk('s3')->url($imagepath);
            }
            return $paths;
        }
    }

}
