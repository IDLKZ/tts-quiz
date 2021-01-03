<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property integer $id
 * @property integer $role_id
 * @property integer $department_id
 * @property string $name
 * @property string $phone
 * @property string $img
 * @property string $position
 * @property string $email
 * @property string $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property Department $department
 * @property Role $role
 * @property BelbinUser[] $belbinUsers
 * @property Invite[] $invites
 * @property Result[] $results
 * @property UserMeaning[] $userMeanings
 * @property UserMotivation[] $userMotivations
 * @property UserMotive[] $userMotives
 * @property UserScale[] $userScales
 */
class User extends Authenticatable
{

    use HasFactory, Notifiable;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['role_id', 'department_id', 'name', 'phone', 'img', 'position', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function belbinUsers()
    {
        return $this->hasMany('App\Models\BelbinUser');
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
    public function results()
    {
        return $this->hasMany('App\Models\Result');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userMeanings()
    {
        return $this->hasMany('App\Models\UserMeaning');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userMotivations()
    {
        return $this->hasMany('App\Models\UserMotivation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userMotives()
    {
        return $this->hasMany('App\Models\UserMotive');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userScales()
    {
        return $this->hasMany('App\Models\UserScale');
    }

    public static function saveData($request){
        $model = new self();
        $input = $request->all();
        $input["password"] = bcrypt($input["password"]);
        $input["img"] = File::saveFile($request,"/uploads/users/","img",$input["name"]);
        $model->fill($input);
        return $model->save();
    }

    public static function updateData($request,$model){
        $input = $request->except('password');
        $input["img"] = File::updateFile($request,"/uploads/users/","img",$model->img,$input["name"]);
        if(strlen(trim($request['password']))){$input["password"] = bcrypt($request['password']);}
        $model->update($input);
        return $model->save();
    }
}
