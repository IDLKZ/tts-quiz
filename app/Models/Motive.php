<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $motivation
 * @property string $loyal
 * @property string $salary
 * @property string $relationship
 * @property string $rule
 * @property string $head
 * @property string $strength
 * @property string $weakness
 * @property string $created_at
 * @property string $updated_at
 * @property JobMotive[] $jobMotives
 * @property MotiveQuestion[] $motiveQuestions
 * @property UserMotive[] $userMotives
 */
class Motive extends Model
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
    protected $fillable = ['title', 'description', 'motivation', 'loyal', 'salary', 'relationship', 'rule', 'head', 'strength', 'weakness', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jobMotives()
    {
        return $this->hasMany('App\Models\JobMotive');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function motiveQuestions()
    {
        return $this->hasMany('App\Models\MotiveQuestion');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userMotives()
    {
        return $this->hasMany('App\Models\UserMotive');
    }
}
