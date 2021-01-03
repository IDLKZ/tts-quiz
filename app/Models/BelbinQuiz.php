<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property BelbinBlog[] $belbinBlogs
 */
class BelbinQuiz extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'belbin_quiz';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['title', 'description', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function belbinBlogs()
    {
        return $this->hasMany('App\Models\BelbinBlog', 'quiz_id');
    }
}
