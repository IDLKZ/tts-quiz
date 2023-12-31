<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PassedLesson
 *
 * @property int $id
 * @property string $uuid
 * @property int $attempt_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property UsersAttempt $users_attempt
 * @property User $user
 *
 * @package App\Models
 */
class PassedLesson extends Model
{
    use Upload;

    protected $table = 'passed_lessons';

	protected $casts = [
		'attempt_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'uuid',
		'attempt_id',
		'user_id'
	];

	public function users_attempt()
	{
		return $this->belongsTo(UsersAttempt::class, 'attempt_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
