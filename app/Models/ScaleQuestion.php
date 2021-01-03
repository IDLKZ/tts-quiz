<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $scale_id
 * @property integer $question_id
 * @property string $answer
 * @property string $created_at
 * @property string $updated_at
 * @property SolovievQuestion $solovievQuestion
 * @property Scale $scale
 */
class ScaleQuestion extends Model
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
    protected $fillable = ['scale_id', 'question_id', 'answer', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function solovievQuestion()
    {
        return $this->belongsTo('App\Models\SolovievQuestion', 'question_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function scale()
    {
        return $this->belongsTo('App\Models\Scale');
    }
}
