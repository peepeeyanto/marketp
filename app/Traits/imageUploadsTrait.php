<?php

namespace App\Traits;
use Illuminate\Http\Request;
use File;
trait imageUploadsTrait{
    public function imageUpload(Request $request, $inputName, $path){
        if($request->hasFile($inputName)){
            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_'.uniqid().'_'.$ext;
            $image->move(public_path($path), $imageName);
            return $path.'/'.$imageName;
        }
    }

    public function imageUpdate(Request $request, $inputName, $path, $oldPath=null){
        if($request->hasFile($inputName)){
            if(File::exists(public_path($oldPath)))
            {
                File::delete(public_path($oldPath));
            }
            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_'.uniqid().'_'.$ext;
            $image->move(public_path($path), $imageName);
            return $path.'/'.$imageName;
        }
    }

    public function imageDelete($path){
        if(File::exists(public_path($path)))
        {
            File::delete(public_path($path));
        }
    }

    public function imageUploadMultiple(Request $request, $inputName, $path){
        $paths = [];
        if($request->hasFile($inputName)){
            $images = $request->{$inputName};

            foreach($images as $image){
                $ext = $image->getClientOriginalExtension();
                $imageName = 'media_'.uniqid().'_'.$ext;
                $image->move(public_path($path), $imageName);
                $paths[] =  $path.'/'.$imageName;
            }
            return $paths;
        }
    }

}
