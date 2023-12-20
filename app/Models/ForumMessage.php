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
 * Class ForumMessage
 *
 * @property int $id
 * @property int $forum_id
 * @property int $user_id
 * @property string $message
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $message_id
 *
 * @property Forum $forum
 * @property ForumMessage $forum_message
 * @property User $user
 * @property Collection|ForumMessageRating[] $forum_message_ratings
 * @property Collection|ForumMessage[] $forum_messages
 *
 * @package App\Models
 */
class ForumMessage extends Model
{
	protected $table = 'forum_messages';
    use Upload;
	protected $casts = [
		'forum_id' => 'int',
		'user_id' => 'int',
		'message_id' => 'int'
	];

	protected $fillable = [
		'forum_id',
		'user_id',
		'message',
		'message_id'
	];

	public function forum()
	{
		return $this->belongsTo(Forum::class);
	}

	public function forum_message()
	{
		return $this->belongsTo(ForumMessage::class, 'message_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function forum_message_ratings()
	{
		return $this->hasMany(ForumMessageRating::class, 'message_id');
	}

	public function forum_messages()
	{
		return $this->hasMany(ForumMessage::class, 'message_id');
	}
}
