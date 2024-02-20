<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NewsGallery
 *
 * @property int $id
 * @property int $news_id
 * @property string $image_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property News $news
 *
 * @package App\Models
 */
class NewsGallery extends Model
{
    use Upload;
	protected $table = 'news_galleries';

	protected $casts = [
		'news_id' => 'int'
	];

	protected $fillable = [
		'news_id',
		'image_url'
	];

	public function news()
	{
		return $this->belongsTo(News::class);
	}
}
