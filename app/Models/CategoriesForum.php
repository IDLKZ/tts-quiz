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
 * Class CategoriesForum
 *
 * @property int $id
 * @property string $image_url
 * @property string $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Forum[] $forums
 *
 * @package App\Models
 */
class CategoriesForum extends Model
{
    use Upload;
	protected $table = 'categories_forum';

	protected $fillable = [
		'image_url',
		'title'
	];

	public function forums()
	{
		return $this->hasMany(Forum::class, 'category_id');
	}
}
