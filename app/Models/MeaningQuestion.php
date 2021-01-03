<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $question_id
 * @property string $meaning
 * @property string $answer
 * @property string $created_at
 * @property string $updated_at
 * @property SolovievQuestion $solovievQuestion
 * @property UserMeaning[] $userMeanings
 */
class MeaningQuestion extends Model
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
    protected $fillable = ['question_id', 'meaning', 'answer', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function solovievQuestion()
    {
        return $this->belongsTo('App\Models\SolovievQuestion', 'question_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userMeanings()
    {
        return $this->hasMany('App\Models\UserMeaning', 'meaning_id');
    }
}
