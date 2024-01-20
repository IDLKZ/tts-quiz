<?php

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Chatter\Core\Traits\CanDiscuss;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;

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
    use Upload;
    use HasFactory, Notifiable;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    protected $casts=[
        "birth_date"=>"datetime"
    ];

    /**
     * @var array
     */
    protected $fillable = ['role_id', 'department_id','candidate', 'name', 'phone', 'img', 'position', 'email','birth_date', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at'];

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
        if($request->role_id == 2){
            $input["candidate"] = $request->has("candidate") == true ? 1 : 0;
        }
        else{
            $input["candidate"] = 0;
        }
        $input["password"] = bcrypt($input["password"]);
        if($request->hasFile("img")){
            $input["img"] = File::base64Decoder($request,"image","/uploads/users/",$request->name);
        }
        else{
            $input["img"] = "/no-image.png";
        }
        if($input["birth_date"]){
            $input["birth_date"] = Carbon::parse($input["birth_date"]);
        }
        $model->fill($input);
        return $model->save();
    }

    public static function updateData($request,$model){
        $input = $request->except('password');
        if(Auth::user()->role_id == 1){
            if($request->role_id == 2){$input["candidate"] = $request->has("candidate") == true ? 1 : 0;}
            else{$input["candidate"] = 0;}
        }
        $input["img"] = File::updateBase64($request,$model,"img","image","/uploads/users/",$request->name);
        if(strlen(trim($request['password']))){$input["password"] = bcrypt($request['password']);}
        if($input["birth_date"]){
            $input["birth_date"] = Carbon::createFromFormat("d/m/Y",$input["birth_date"]);
        }
        $model->update($input);
        return $model->save();
    }


    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'user_has_permissions', 'user_id', 'permission_id');
    }

    public function hasPermission($permissionName){
        $permissionNames = $this->permissions()->pluck("name")->toArray();
        return in_array($permissionName,$permissionNames);
    }
}
