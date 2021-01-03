<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $result_id
 * @property int $rating
 * @property string $meaning
 * @property Result $result
 * @property User $user
 */
class UserMotivation extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'user_motivation';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'result_id', 'rating', 'meaning'];

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
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
