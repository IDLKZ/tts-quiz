<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Event
 *
 * @property int $id
 * @property string $image_url
 * @property string $title
 * @property string $description
 * @property string $address
 * @property Carbon $start_date
 * @property Carbon|null $end_date
 * @property point|null $location
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Event extends Model
{
	protected $table = 'events';
    use Upload;
	protected $casts = [
		'start_date' => 'datetime',
		'end_date' => 'datetime',
		'location' => 'point',
        'departments' => 'json'
	];

	protected $fillable = [
		'image_url',
		'title',
		'description',
        'departments',
		'address',
		'start_date',
		'end_date',
		'location'
	];
}
