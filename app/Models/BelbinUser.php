<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $result_id
 * @property integer $role_id
 * @property string $rating
 * @property string $percentage
 * @property string $created_at
 * @property string $updated_at
 * @property Result $result
 * @property BelbinRole $belbinRole
 * @property User $user
 */
class BelbinUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'belbin_user';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'result_id', 'role_id', 'rating', 'percentage', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function result()
    {
        return $this->belongsTo('App\Models\Result');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function belbinRole()
    {
        return $this->belongsTo('App\Models\BelbinRole', 'role_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public static function saveData($data,$result){
        foreach ($data as $role_id => $rating){
            $model = new self();
            $model->user_id = Auth::id();
            $model->result_id = $result;
            $model->role_id = $role_id;
            $model->rating = $rating;
            $model->percentage = round($rating/0.7,2);
            $model->result_id = $result;
            $model->save();
        }
    }
}
