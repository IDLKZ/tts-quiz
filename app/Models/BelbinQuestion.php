<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $blog_id
 * @property integer $role_id
 * @property string $question
 * @property string $created_at
 * @property string $updated_at
 * @property BelbinBlog $belbinBlog
 * @property BelbinRole $belbinRole
 */
class BelbinQuestion extends Model
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
    protected $fillable = ['blog_id', 'role_id', 'question', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function belbinBlog()
    {
        return $this->belongsTo('App\Models\BelbinBlog', 'blog_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function belbinRole()
    {
        return $this->belongsTo('App\Models\BelbinRole', 'role_id');
    }
}
