<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ForumMessageRating
 *
 * @property int $id
 * @property int $user_id
 * @property int $message_id
 * @property int $rating
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property ForumMessage $forum_message
 * @property User $user
 *
 * @package App\Models
 */
class ForumMessageRating extends Model
{
	protected $table = 'forum_message_ratings';
    use Upload;
	protected $casts = [
		'user_id' => 'int',
		'message_id' => 'int',
		'rating' => 'int'
	];

	protected $fillable = [
		'user_id',
		'message_id',
		'rating'
	];

	public function forum_message()
	{
		return $this->belongsTo(ForumMessage::class, 'message_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
