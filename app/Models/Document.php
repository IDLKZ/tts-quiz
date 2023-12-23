<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Document
 *
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property string $description
 * @property string $image_url
 * @property string|null $file_type
 * @property string|null $file_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property DocumentCategory $document_category
 *
 * @package App\Models
 */
class Document extends Model
{
    use Upload;
	protected $table = 'documents';

	protected $casts = [
		'category_id' => 'int'
	];

	protected $fillable = [
		'category_id',
		'title',
		'description',
		'image_url',
		'file_type',
		'file_url'
	];

	public function document_category()
	{
		return $this->belongsTo(DocumentCategory::class, 'category_id');
	}
}
