<?php

namespace App\Models;

use App\Traits\Upload;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $guard_name
 * @property string $created_at
 * @property string $updated_at
 * @property UserHasPermission[] $userHasPermissions
 */
class Permission extends Model
{
    use Upload;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'guard_name', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userHasPermissions()
    {
        return $this->hasMany(UserHasPermission::class,"permission_id","id");
    }
}
