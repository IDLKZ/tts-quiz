<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ForumRating
 *
 * @property int $id
 * @property int $user_id
 * @property int $forum_id
 * @property int $rating
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Forum $forum
 * @property User $user
 *
 * @package App\Models
 */
class ForumRating extends Model
{
	protected $table = 'forum_ratings';
    use Upload;
	protected $casts = [
		'user_id' => 'int',
		'forum_id' => 'int',
		'rating' => 'int'
	];

	protected $fillable = [
		'user_id',
		'forum_id',
		'rating'
	];

	public function forum()
	{
		return $this->belongsTo(Forum::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
