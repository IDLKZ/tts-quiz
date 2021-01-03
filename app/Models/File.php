<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class File extends Model
{
    use HasFactory;

    public static function saveFile($request,$directory,$file,$name = null){
        if($request->hasFile($file)){
            if($name){
                $filename = Str::slug($name) . Str::random(5);
            }
            else{
                $filename = Str::random(12);
            }
            $file = $request->file($file);
           $filename = $filename.".".$file->extension();
           if($file->storeAs($directory, $filename)){
               return  $directory . $filename;
           }
           else{
               return "no-image.png";
           }
        }
        else{
            return "no-image.png";
        }
    }

    public static function updateFile($request,$directory,$file,$oldname,$name = null){
        if($request->hasFile($file)){
            return  self::saveFile($request,$directory,$file,$name);
        }
        else{
            return $oldname;
        }
    }

    public static function deleteFile($filename){
        if(Storage::disk("local")->exists($filename) && $filename != "no-image.png"){
            Storage::disk("local")->delete($filename);
        }
    }






}
