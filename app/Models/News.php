<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = ["id","title","subtitle","description","img"];





    public static function saveData($request){
        $input = $request->all();
        $input["img"] = File::saveFile($request,"/uploads/news/","img",$input["title"]);
        $model = new self();
        return $model->fill($input)->save();
    }
    public static function updateData($request,$model){
        $input = $request->all();
        $input["img"] = File::saveFile($request,"/uploads/news/","img",$input["title"]);
        return $model->update($input);
    }



}
