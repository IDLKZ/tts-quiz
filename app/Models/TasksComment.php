<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TasksComment
 *
 * @property int $id
 * @property int $task_id
 * @property int $user_id
 * @property string $comment
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Task $task
 * @property User $user
 *
 * @package App\Models
 */
class TasksComment extends Model
{
    use Upload;
	protected $table = 'tasks_comments';

	protected $casts = [
		'task_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'task_id',
		'user_id',
		'comment'
	];

	public function task()
	{
		return $this->belongsTo(Task::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
