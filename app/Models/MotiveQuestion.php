<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $question_id
 * @property integer $motive_id
 * @property string $answer
 * @property string $created_at
 * @property string $updated_at
 * @property Motive $motive
 * @property SolovievQuestion $solovievQuestion
 */
class MotiveQuestion extends Model
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
    protected $fillable = ['question_id', 'motive_id', 'answer', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function motive()
    {
        return $this->belongsTo('App\Models\Motive');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function solovievQuestion()
    {
        return $this->belongsTo('App\Models\SolovievQuestion', 'question_id');
    }
}
