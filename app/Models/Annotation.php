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
 * Class Annotation
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property array|null $companies
 * @property array|null $departments
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property Collection|AnnotationComment[] $annotation_comments
 *
 * @package App\Models
 */
class Annotation extends Model
{
	protected $table = 'annotations';
    use Upload;
	protected $casts = [
		'user_id' => 'int',
		'companies' => 'json',
		'departments' => 'json'
	];

	protected $fillable = [
		'user_id',
		'title',
		'description',
		'companies',
		'departments'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function annotation_comments()
	{
		return $this->hasMany(AnnotationComment::class);
	}
}
