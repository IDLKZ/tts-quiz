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
 * Class Questionnaire
 *
 * @property int $id
 * @property string|null $image_url
 * @property string $title
 * @property string $description
 * @property array|null $departments
 * @property Carbon $start_at
 * @property Carbon $end_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|QuestionnaireQuestion[] $questionnaire_questions
 * @property Collection|QuestionnaireResult[] $questionnaire_results
 *
 * @package App\Models
 */
class Questionnaire extends Model
{
    use Upload;
	protected $table = 'questionnaires';

	protected $casts = [
		'departments' => 'json',
		'start_at' => 'datetime',
		'end_at' => 'datetime'
	];

	protected $fillable = [
		'image_url',
		'title',
		'description',
		'departments',
		'start_at',
		'end_at'
	];

	public function questionnaire_questions()
	{
		return $this->hasMany(QuestionnaireQuestion::class);
	}

	public function questionnaire_results()
	{
		return $this->hasMany(QuestionnaireResult::class);
	}
}
