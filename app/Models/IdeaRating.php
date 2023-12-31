<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IdeaRating
 *
 * @property int $id
 * @property int $idea_id
 * @property int $user_id
 * @property int $rating
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Idea $idea
 * @property User $user
 *
 * @package App\Models
 */
class IdeaRating extends Model
{
    use Upload;
    protected $table = 'idea_ratings';

	protected $casts = [
		'idea_id' => 'int',
		'user_id' => 'int',
		'rating' => 'int'
	];

	protected $fillable = [
		'idea_id',
		'user_id',
		'rating'
	];

	public function idea()
	{
		return $this->belongsTo(Idea::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
