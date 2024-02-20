<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $casts=[
      "is_main"=>"boolean"
    ];

    protected $fillable = ["id","title","subtitle","description","img","is_main"];





    public static function saveData($request){
        $input = $request->all();
        $input["is_main"] = $request->boolean("is_main");
        $input["img"] = File::saveFile($request,"/uploads/news/","img",$input["title"]);
        $model = new self();
        $model->fill($input)->save();
        if($request->has("images")){
            foreach ($request->file("images") as $image){
                $newsGallery = NewsGallery::add(["news_id"=>$model->id]);
                $newsGallery->uploadFile($image,"image_url");
            }
        }
        return true;
    }
    public static function updateData($request,$model){
        $input = $request->all();
        $input["is_main"] = $request->boolean("is_main");
        if($request->file("img")){
            $input["img"] = File::saveFile($request,"/uploads/news/","img",$input["title"]);
        }
        $model->update($input);
        if($request->has("images")){
            foreach ($request->file("images") as $image){
                $newsGallery = NewsGallery::add(["news_id"=>$model->id]);
                $newsGallery->uploadFile($image,"image_url");
            }
        }
        if($request->get("deletedGalleryId")){
            $deleted = json_decode($request->get("deletedGalleryId"),true);
            $deleted = array_map('intval', $deleted);
            NewsGallery::destroy($deleted);
        }
        return true;
    }

    public function galleries()
    {
        return $this->hasMany(NewsGallery::class,"news_id","id");
    }



}
