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
        $input = self::getInitialData($request);
        $model = new self();
        return $model->fill($input)->save();
    }
    public static function updateData($request,$model){
        $input = self::getInitialData($request);
        return $model->update($input);
    }

    /**
     * @param $request
     * @return mixed
     */
    public static function getInitialData($request)
    {
        $input = $request->except('img');
        $imgUrl = [];
        $input["is_main"] = $request->boolean("is_main");
        foreach ($request['img'] as $item) {
            $imgUrl[] .= File::saveJsonFile($item, "/uploads/news/", $input["title"]);
        }
        $input['img'] = json_encode($imgUrl);
        return $input;
    }


}
