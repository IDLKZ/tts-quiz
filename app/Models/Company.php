<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $logo
 * @property Department[] $departments
 */
class Company extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';
    public $timestamps = false;
    protected $directory = "/assets/uploads/companies/";

    /**
     * @var array
     */
    protected $fillable = ['title', 'logo', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departments()
    {
        return $this->hasMany('App\Models\Department');
    }


    public static function saveData($request){
        $model = new self();
        $input = $request->all();
        if($request->hasFile("logo")){
            $input["logo"] = File::base64Decoder($request,"image","/uploads/companies/",$request->title);
        }
        else{
            $input["logo"] = "/no-image.png";
        }


        $model->fill($input);
        return $model->save();
    }

    public static function updateData($request,$model){
        $input = $request->all();
        $input["logo"] = File::updateBase64($request,$model,"logo","image","/uploads/companies/",$request->title);
        $model->update($input);
        return $model->save();
    }




}
