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
 * Class Forum
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $user_id
 * @property array|null $companies
 * @property array|null $departments
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property Collection|ForumMessage[] $forum_messages
 * @property Collection|ForumRating[] $forum_ratings
 *
 * @package App\Models
 */
class Forum extends Model
{
	protected $table = 'forums';
    use Upload;
	protected $casts = [
		'user_id' => 'int',
		'companies' => 'json',
		'departments' => 'json'
	];

	protected $fillable = [
		'title',
		'description',
		'user_id',
		'companies',
		'departments'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function forum_messages()
	{
		return $this->hasMany(ForumMessage::class);
	}

	public function forum_ratings()
	{
		return $this->hasMany(ForumRating::class);
	}
}
