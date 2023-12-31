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
 * Class Idea
 *
 * @property int $id
 * @property string $title
 * @property string|null $image_url
 * @property string $description
 * @property array|null $keywords
 * @property int $user_id
 * @property string|null $file_url
 * @property int $status
 * @property string $opinion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property Collection|IdeaRating[] $idea_ratings
 * @property Collection|Ticket[] $tickets
 *
 * @package App\Models
 */
class Idea extends Model
{
    use Upload;
	protected $table = 'ideas';

	protected $casts = [
		'keywords' => 'json',
		'user_id' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'title',
		'image_url',
		'description',
		'keywords',
		'user_id',
		'file_url',
		'status',
		'opinion'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function idea_ratings()
	{
		return $this->hasMany(IdeaRating::class);
	}

}
