<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property integer $id
 * @property integer $department_id
 * @property integer $user_id
 * @property integer $type_id
 * @property string $title
 * @property string $simple_quiz
 * @property int $status
 * @property string $start
 * @property string $end
 * @property string $created_at
 * @property string $updated_at
 * @property Department $department
 * @property Type $type
 * @property User $user
 * @property Result[] $results
 */
class Invite extends Model
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
    protected $fillable = ['department_id', 'user_id', 'type_id', 'title', 'simple_quiz', 'status', 'visible' , 'start', 'end', 'created_at', 'updated_at'];

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
    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function results()
    {
        return $this->hasMany('App\Models\Result', 'invites_id');
    }

    public function company(){
        return $this->hasManyThrough(Company::class,Department::class,"id","company_id","department_id","");
    }
    public static function saveData($request){
        $model = new self();
        $input = $request->all();
        $input["visible"] = $request->has("visible") == 1 ? true : false;
        $model->fill($input);
        $model->save();
        return $model->id;
    }

    public static function updateData($request,$model){
        $input = $request->all();
        if (Auth::user()->role_id == 1){
            $input["visible"] = $request->has("visible") == 1 ? true : false;
        }
        $model->update($input);
        return $model->save();
    }
}
