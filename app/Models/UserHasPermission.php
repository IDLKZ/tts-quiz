<?php

namespace App\Models;

use App\Traits\Upload;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $permission_id
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property Permission $permission
 * @property User $user
 */
class UserHasPermission extends Model
{
    use Upload;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_has_permissions';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['permission_id', 'user_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permission()
    {
        return $this->belongsTo(Permission::class,"permission_id","id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class,"user_id","id");
    }
}
