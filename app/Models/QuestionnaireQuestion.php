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
 * Class QuestionnaireQuestion
 *
 * @property int $id
 * @property int $questionnaire_id
 * @property string $question
 * @property string|null $context
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Questionnaire $questionnaire
 * @property Collection|QuestionnaireAnswer[] $questionnaire_answers
 * @property Collection|QuestionnaireResult[] $questionnaire_results
 *
 * @package App\Models
 */
class QuestionnaireQuestion extends Model
{
    use Upload;
	protected $table = 'questionnaire_questions';

	protected $casts = [
		'questionnaire_id' => 'int'
	];

	protected $fillable = [
		'questionnaire_id',
		'question',
		'context'
	];

	public function questionnaire()
	{
		return $this->belongsTo(Questionnaire::class);
	}

	public function questionnaire_answers()
	{
		return $this->hasMany(QuestionnaireAnswer::class, 'question_id');
	}

	public function questionnaire_results()
	{
		return $this->hasMany(QuestionnaireResult::class, 'question_id');
	}
}
