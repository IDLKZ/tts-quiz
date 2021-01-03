<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $test_id
 * @property integer $test_type
 * @property string $question
 * @property string $A
 * @property string $B
 * @property string $C
 * @property string $D
 * @property string $E
 * @property string $F
 * @property int $number
 * @property string $created_at
 * @property string $updated_at
 * @property SolovievTest $solovievTest
 * @property TestType $testType
 * @property MeaningQuestion[] $meaningQuestions
 * @property MotiveQuestion[] $motiveQuestions
 * @property ScaleQuestion[] $scaleQuestions
 */
class SolovievQuestion extends Model
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
    protected $fillable = ['test_id', 'test_type', 'question', 'A', 'B', 'C', 'D', 'E', 'F', 'number', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function solovievTest()
    {
        return $this->belongsTo('App\Models\SolovievTest', 'test_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function testType()
    {
        return $this->belongsTo('App\Models\TestType', 'test_type');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function meaningQuestions()
    {
        return $this->hasMany('App\Models\MeaningQuestion', 'question_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function motiveQuestions()
    {
        return $this->hasMany('App\Models\MotiveQuestion', 'question_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scaleQuestions()
    {
        return $this->hasMany('App\Models\ScaleQuestion', 'question_id');
    }
}
