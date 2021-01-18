<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $company_id
 * @property string $title
 * @property string $description
 * @property string $logo
 * @property string $created_at
 * @property string $updated_at
 * @property Company $company
 * @property Invite[] $invites
 * @property User[] $users
 */
class Department extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['company_id', 'title', 'description', 'logo', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invites()
    {
        return $this->hasMany('App\Models\Invite');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }


    public static function saveData($request){
        $model = new self();
        $input = $request->all();
        $input["logo"] = File::base64Decoder($request,"image","/uploads/departments/",$request->title);
        $model->fill($input);
        return $model->save();
    }

    public static function updateData($request,$model){
        $input = $request->all();
        $input["logo"] = File::updateBase64($request,$model,"logo","image","/uploads/departments/",$request->title);
        $model->update($input);
        return $model->save();
    }
}
