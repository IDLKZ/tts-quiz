<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SavedNews
 *
 * @property int $id
 * @property int $news_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property News $news
 * @property User $user
 *
 * @package App\Models
 */
class SavedNews extends Model
{
	protected $table = 'saved_news';
    use Upload;
	protected $casts = [
		'news_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'news_id',
		'user_id'
	];

	public function news()
	{
		return $this->belongsTo(News::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
