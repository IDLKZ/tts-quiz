<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AnnotationComment
 *
 * @property int $id
 * @property int $annotation_id
 * @property int $user_id
 * @property string $comment
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Annotation $annotation
 * @property User $user
 *
 * @package App\Models
 */
class AnnotationComment extends Model
{
	protected $table = 'annotation_comments';
    use Upload;
	protected $casts = [
		'annotation_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'annotation_id',
		'user_id',
		'comment'
	];

	public function annotation()
	{
		return $this->belongsTo(Annotation::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
