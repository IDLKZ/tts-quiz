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
               return "/no-image.png";
           }
        }
        else{
            return "/no-image.png";
        }
    }
    public static function saveJsonFile($file,$directory,$name = null){
        if($file){
            if($name){
                $filename = Str::slug($name) . Str::random(5);
            }
            else{
                $filename = Str::random(12);
            }
           $filename = $filename.".".$file->extension();
           if($file->storeAs($directory, $filename)){
               return  $directory . $filename;
           }
           else{
               return "/no-image.png";
           }
        }
        else{
            return "/no-image.png";
        }
    }

    public static function updateFile($request,$directory,$file,$oldname,$name = null){
        if($request->hasFile($file)){
            self::deleteFile($oldname);
            return  self::saveFile($request,$directory,$file,$name);
        }
        else{
            return $oldname;
        }
    }

    public static function deleteFile($filename){
        if(Storage::disk("local")->exists($filename) && $filename != "/no-image.png"){
            Storage::disk("local")->delete($filename);
        }
    }

    public static function base64Decoder($request,$name,$direction,$title = false){
        $base64_image = $request->input($name); // your base64 encoded
        @list($type, $file_data) = explode(';', $base64_image);
        @list(, $file_data) = explode(',', $file_data);
        $imageName = $title != false ? Str::slug($title) . Str::random(5).'.'.'png'    : Str::random(10).'.'.'png';
        $imageName = $direction . $imageName;
        Storage::disk('local')->put($imageName, base64_decode($file_data));
        return $imageName;
    }
    public static function updateBase64($request,$model,$img,$name,$direction,$title = false){
        $imageName = $model[$img];
        if($request->hasFile($img)){
            $base64_image = $request->input($name); // your base64 encoded
            @list($type, $file_data) = explode(';', $base64_image);
            @list(, $file_data) = explode(',', $file_data);
            $imageName = $title != false ? Str::slug($title) . Str::random(5).'.'.'png'    : Str::random(10).'.'.'png';
            $imageName = $direction . $imageName;
            if(Storage::exists($model[$img])){Storage::delete($model[$img]);}
            Storage::disk('local')->put($imageName, base64_decode($file_data));
            return $imageName;
        }
        else{
            return $imageName;
        }

    }





}
