<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;
use Image;
class FileManagement extends Model
{
    use HasFactory; 
    
    public function upload_single_file($request,$fileName,$destination,$ratio = '',$width = '',$height = '') {
        $file = $request->file($fileName);
        Storage::disk('public')->makeDirectory($destination.'/');
        $newFileName = $destination.time().rand(1,100).'.'.$file->getClientOriginalExtension();
        $image = Image::make($file);
        $image->resize($width, $height, function ($constraint) use ($ratio) {
            if($ratio == 'yes'){
                $constraint->aspectRatio();
            }
        });
        $image->save(storage_path('app/public/'.$destination.'/'.$newFileName));
        return $newFileName;
    }
    public function upload_multi_file($request,$fileName,$destination,$ratio = '',$width = '',$height = '') {
        $files = $request->file($fileName);
        $allFileName = [];
        foreach($files as $file){
            Storage::disk('public')->makeDirectory($destination.'/');
            $newFileName = $destination.time().rand(1,100).'.'.$file->getClientOriginalExtension();
            dd($newFileName);
            $image = Image::make($file);
            $image->resize($width, $height, function ($constraint) use ($ratio) {
                if($ratio == 'yes'){
                    $constraint->aspectRatio();
                }
            });
            $image->save(storage_path('app/public/'.$destination.'/'.$newFileName));
            array_push($allFileName,$newFileName);
        }
        return $allFileName;
    }
    public function view_file($location,$value)
    {
        return url("/storage/".$location."/".$value);
    }
}
