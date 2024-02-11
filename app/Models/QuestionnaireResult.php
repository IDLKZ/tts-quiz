<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QuestionnaireResult
 * 
 * @property int $id
 * @property int $questionnaire_id
 * @property int $question_id
 * @property int $answer_id
 * @property int $department_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property QuestionnaireAnswer $questionnaire_answer
 * @property Department $department
 * @property QuestionnaireQuestion $questionnaire_question
 * @property Questionnaire $questionnaire
 * @property User $user
 *
 * @package App\Models
 */
class QuestionnaireResult extends Model
{
	protected $table = 'questionnaire_results';

	protected $casts = [
		'questionnaire_id' => 'int',
		'question_id' => 'int',
		'answer_id' => 'int',
		'department_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'questionnaire_id',
		'question_id',
		'answer_id',
		'department_id',
		'user_id'
	];

	public function questionnaire_answer()
	{
		return $this->belongsTo(QuestionnaireAnswer::class, 'answer_id');
	}

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
