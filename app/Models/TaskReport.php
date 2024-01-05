<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TaskReport
 *
 * @property int $id
 * @property int $task_id
 * @property int $user_id
 * @property int $status
 * @property bool $is_ready
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Task $task
 * @property User $user
 *
 * @package App\Models
 */
class TaskReport extends Model
{
    use Upload;
	protected $table = 'task_reports';

	protected $casts = [
		'task_id' => 'int',
		'user_id' => 'int',
		'status' => 'int',
		'is_ready' => 'bool'
	];

	protected $fillable = [
		'task_id',
		'user_id',
		'status',
		'is_ready'
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
