<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $quiz_id
 * @property string $title
 * @property string $description
 * @property int $number
 * @property string $created_at
 * @property string $updated_at
 * @property BelbinQuiz $belbinQuiz
 * @property BelbinQuestion[] $belbinQuestions
 */
class BelbinBlog extends Model
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
    protected $fillable = ['quiz_id', 'title', 'description', 'number', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function belbinQuiz()
    {
        return $this->belongsTo('App\Models\BelbinQuiz', 'quiz_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function belbinQuestions()
    {
        return $this->hasMany('App\Models\BelbinQuestion', 'blog_id');
    }
}
