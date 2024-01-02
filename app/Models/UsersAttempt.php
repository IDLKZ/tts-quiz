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
 * Class UsersAttempt
 *
 * @property int $id
 * @property int $user_id
 * @property int $lesson_id
 * @property bool $is_passed
 * @property int|null $points
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Lesson $lesson
 * @property User $user
 * @property Collection|PassedLesson[] $passed_lessons
 * @property Collection|PassedQuestion[] $passed_questions
 *
 * @package App\Models
 */
class UsersAttempt extends Model
{
    use Upload;

    protected $table = 'users_attempts';

	protected $casts = [
		'user_id' => 'int',
		'lesson_id' => 'int',
		'is_passed' => 'bool',
		'points' => 'int'
	];

	protected $fillable = [
		'user_id',
		'lesson_id',
		'is_passed',
		'points'
	];

	public function lesson()
	{
		return $this->belongsTo(Lesson::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function passed_lessons()
	{
		return $this->hasOne(PassedLesson::class, 'attempt_id');
	}

	public function passed_questions()
	{
		return $this->hasMany(PassedQuestion::class, 'attempt_id');
	}
}
