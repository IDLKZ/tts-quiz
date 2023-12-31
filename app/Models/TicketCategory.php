<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TicketCategory
 *
 * @property int $id
 * @property string $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class TicketCategory extends Model
{
    use Upload;

    protected $table = 'ticket_categories';

	protected $fillable = [
		'title'
	];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'category_id');
    }
}
