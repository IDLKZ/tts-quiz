<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $scale_id
 * @property integer $result_id
 * @property int $rating
 * @property int $percentage
 * @property string $meaning
 * @property string $created_at
 * @property string $updated_at
 * @property Result $result
 * @property Scale $scale
 * @property User $user
 */
class UserScale extends Model
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
    protected $fillable = ['user_id', 'scale_id', 'result_id', 'rating', 'percentage', 'meaning', 'created_at', 'updated_at'];

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
    public function scale()
    {
        return $this->belongsTo('App\Models\Scale');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
