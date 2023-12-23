<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 *
 * @property int $id
 * @property string $task
 * @property string $details
 * @property array $users
 * @property int $user_id
 * @property int $importance
 * @property int $status
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $department_id
 *
 * @property Department $department
 * @property User $user
 * @property Collection|TasksComment[] $tasks_comments
 *
 * @package App\Models
 */
class Task extends Model
{
    use Upload;
	protected $table = 'tasks';

	protected $casts = [
		'users' => 'json',
		'user_id' => 'int',
		'importance' => 'int',
		'status' => 'int',
		'start_date' => 'datetime',
		'end_date' => 'datetime',
		'department_id' => 'int'
	];

	protected $fillable = [
		'task',
		'details',
		'users',
		'user_id',
		'importance',
		'status',
		'start_date',
		'end_date',
		'department_id'
	];

	public function department()
	{
		return $this->belongsTo(Department::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function tasks_comments()
	{
		return $this->hasMany(TasksComment::class);
	}
}
