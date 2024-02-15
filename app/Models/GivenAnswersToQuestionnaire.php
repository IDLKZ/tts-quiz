<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GivenAnswersToQuestionnaire
 *
 * @property int $id
 * @property int $questionnaire_id
 * @property int $question_id
 * @property string $given_answer
 * @property int $department_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Department $department
 * @property QuestionnaireQuestion $questionnaire_question
 * @property Questionnaire $questionnaire
 * @property User $user
 *
 * @package App\Models
 */
class GivenAnswersToQuestionnaire extends Model
{
    use Upload;
	protected $table = 'given_answers_to_questionnaire';

	protected $casts = [
		'questionnaire_id' => 'int',
		'question_id' => 'int',
		'department_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'questionnaire_id',
		'question_id',
		'given_answer',
		'department_id',
		'user_id'
	];

	public function department()
	{
		return $this->belongsTo(Department::class);
	}

	public function questionnaire_question()
	{
		return $this->belongsTo(QuestionnaireQuestion::class, 'question_id');
	}

	public function questionnaire()
	{
		return $this->belongsTo(Questionnaire::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
