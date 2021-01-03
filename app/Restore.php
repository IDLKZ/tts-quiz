<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property integer $user_id
 * @property string $email
 * @property string $token
 * @property string $time
 */
class Restore extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'restore';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'email', 'token', 'time'];

}
