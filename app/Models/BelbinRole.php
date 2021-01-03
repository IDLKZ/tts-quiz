<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property BelbinQuestion[] $belbinQuestions
 * @property BelbinUser[] $belbinUsers
 */
class BelbinRole extends Model
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
    protected $fillable = ['title', 'description', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function belbinQuestions()
    {
        return $this->hasMany('App\Models\BelbinQuestion', 'role_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function belbinUsers()
    {
        return $this->hasMany('App\Models\BelbinUser', 'role_id');
    }
}
