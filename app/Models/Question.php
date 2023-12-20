<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 *
 * @property int $id
 * @property int $lesson_id
 * @property string $answer
 * @property string $context
 * @property string $a
 * @property string $b
 * @property string $c
 * @property string|null $d
 * @property string|null $e
 * @property string|null $f
 * @property string|null $g
 * @property string|null $h
 * @property string $correct_answer
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Course $course
 *
 * @package App\Models
 */
class Question extends Model
{
	protected $table = 'questions';
    use Upload;
	protected $casts = [
		'lesson_id' => 'int'
	];

	protected $fillable = [
		'lesson_id',
		'text',
		'context',
		'a',
		'b',
		'c',
		'd',
		'e',
		'f',
		'g',
		'h',
		'correct_answer'
	];

	public function lesson()
	{
		return $this->belongsTo(Lesson::class, 'lesson_id');
	}
}
