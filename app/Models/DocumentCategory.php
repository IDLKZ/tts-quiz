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
 * Class DocumentCategory
 *
 * @property int $id
 * @property string $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Document[] $documents
 *
 * @package App\Models
 */
class DocumentCategory extends Model
{
    use Upload;
	protected $table = 'document_categories';

	protected $fillable = [
		'title'
	];

	public function documents()
	{
		return $this->hasMany(Document::class, 'category_id');
	}
}
