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
 * Class Course
 *
 * @property int $id
 * @property string $alias
 * @property string $title
 * @property string $subtitle
 * @property string $description
 * @property string $image_url
 * @property array|null $companies
 * @property array|null $departments
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Lesson[] $lessons
 * @property Collection|Question[] $questions
 *
 * @package App\Models
 */
class Course extends Model
{
	protected $table = 'courses';
    use Upload;
	protected $casts = [
		'companies' => 'json',
		'departments' => 'json'
	];

	protected $fillable = [
		'alias',
		'title',
		'subtitle',
		'description',
		'image_url',
		'companies',
		'departments'
	];

	public function lessons()
	{
		return $this->hasMany(Lesson::class)->orderBy("order","asc");
	}

	public function questions()
	{
		return $this->hasMany(Question::class, 'lesson_id');
	}
}
