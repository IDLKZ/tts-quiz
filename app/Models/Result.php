<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $invites_id
 * @property integer $job_id
 * @property string $position
 * @property string $pass_time
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property Invite $invite
 * @property Job $job
 * @property User $user
 * @property BelbinUser[] $belbinUsers
 * @property UserMeaning[] $userMeanings
 * @property UserMotivation[] $userMotivations
 * @property UserMotive[] $userMotives
 * @property UserScale[] $userScales
 */
class Result extends Model
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
    protected $fillable = ['user_id', 'invites_id', 'job_id', 'position', 'pass_time', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invite()
    {
        return $this->belongsTo('App\Models\Invite', 'invites_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function job()
    {
        return $this->belongsTo('App\Models\Job');
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
    public function belbinUsers()
    {
        return $this->hasMany('App\Models\BelbinUser');
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
}
