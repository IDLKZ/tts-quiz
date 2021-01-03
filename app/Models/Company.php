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

    protected $directory = "/assets/uploads/companies/";

    /**
     * @var array
     */
    protected $fillable = ['title', 'description', 'logo'];

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
        $input["logo"] = File::saveFile($request,(new self())->directory,"logo",$input["title"]);
        $model->fill($input);
        return $model->save();
    }

    public static function updateData($request,$model){
        $input = $request->all();
        $input["logo"] = File::updateFile($request,(new self())->directory,"logo",$model->logo,$input["title"]);
        $model->update($input);
        return $model->save();
    }




}
