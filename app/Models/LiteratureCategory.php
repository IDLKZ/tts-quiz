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
 * Class LiteratureCategory
 *
 * @property int $id
 * @property string $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Literature[] $literatures
 *
 * @package App\Models
 */
class LiteratureCategory extends Model
{
    use Upload;
	protected $table = 'literature_categories';

	protected $fillable = [
		'title'
	];

	public function literatures()
	{
		return $this->hasMany(Literature::class, 'category_id');
	}
}
