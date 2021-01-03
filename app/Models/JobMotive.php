<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $motive_id
 * @property integer $job_id
 * @property int $status
 * @property int $min
 * @property int $max
 * @property string $created_at
 * @property string $updated_at
 * @property Job $job
 * @property Motive $motive
 */
class JobMotive extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'job_motive';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['motive_id', 'job_id', 'status', 'min', 'max', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function job()
    {
        return $this->belongsTo('App\Models\Job');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function motive()
    {
        return $this->belongsTo('App\Models\Motive');
    }
}
