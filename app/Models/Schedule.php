<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Schedule
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property Carbon $start_at
 * @property Carbon $end_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 *
 * @package App\Models
 */
class Schedule extends Model
{
    use Upload;
	protected $table = 'schedules';

	protected $casts = [
		'user_id' => 'int',
		'start_at' => 'datetime',
		'end_at' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'title',
		'description',
		'start_at',
		'end_at'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
