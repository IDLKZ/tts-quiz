<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $meaning_id
 * @property integer $result_id
 * @property string $meaning
 * @property string $created_at
 * @property string $updated_at
 * @property MeaningQuestion $meaningQuestion
 * @property Result $result
 * @property User $user
 */
class UserMeaning extends Model
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
    protected $fillable = ['user_id', 'meaning_id', 'result_id', 'meaning', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function meaningQuestion()
    {
        return $this->belongsTo('App\Models\MeaningQuestion', 'meaning_id');
    }

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
