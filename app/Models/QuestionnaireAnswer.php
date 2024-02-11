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
 * Class QuestionnaireAnswer
 *
 * @property int $id
 * @property int $question_id
 * @property string $answer
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property QuestionnaireQuestion $questionnaire_question
 * @property Collection|QuestionnaireResult[] $questionnaire_results
 *
 * @package App\Models
 */
class QuestionnaireAnswer extends Model
{
    use Upload;
	protected $table = 'questionnaire_answers';

	protected $casts = [
		'question_id' => 'int'
	];

	protected $fillable = [
		'question_id',
		'answer'
	];

	public function questionnaire_question()
	{
		return $this->belongsTo(QuestionnaireQuestion::class, 'question_id');
	}

	public function questionnaire_results()
	{
		return $this->hasMany(QuestionnaireResult::class, 'answer_id');
	}
}
