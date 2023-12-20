<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LessonLike
 *
 * @property int $id
 * @property int $user_id
 * @property int $lesson_id
 * @property int $rating
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Lesson $lesson
 * @property User $user
 *
 * @package App\Models
 */
class LessonLike extends Model
{
	protected $table = 'lesson_likes';
    use Upload;
	protected $casts = [
		'user_id' => 'int',
		'lesson_id' => 'int',
		'rating' => 'int'
	];

	protected $fillable = [
		'user_id',
		'lesson_id',
		'rating'
	];

	public function lesson()
	{
		return $this->belongsTo(Lesson::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
