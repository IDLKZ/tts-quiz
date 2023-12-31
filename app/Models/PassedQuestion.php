<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PassedQuestion
 *
 * @property int $id
 * @property int $attempt_id
 * @property int $question_id
 * @property string|null $given_answer
 * @property bool $is_right
 * @property bool $is_answered
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property UsersAttempt $users_attempt
 * @property Question $question
 *
 * @package App\Models
 */
class PassedQuestion extends Model
{
    use Upload;

    protected $table = 'passed_questions';

	protected $casts = [
		'attempt_id' => 'int',
		'question_id' => 'int',
		'is_right' => 'bool',
		'is_answered' => 'bool'
	];

	protected $fillable = [
		'attempt_id',
		'question_id',
		'given_answer',
		'is_right',
		'is_answered'
	];

	public function users_attempt()
	{
		return $this->belongsTo(UsersAttempt::class, 'attempt_id');
	}

	public function question()
	{
		return $this->belongsTo(Question::class);
	}
}
