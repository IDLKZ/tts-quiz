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
 * Class Ticket
 *
 * @property int $id
 * @property int $category_id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property string|null $file_url
 * @property bool $is_answered
 * @property bool $is_resolved
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Idea $idea
 * @property User $user
 * @property Collection|TicketMessage[] $ticket_messages
 *
 * @package App\Models
 */
class Ticket extends Model
{
    use Upload;

    protected $table = 'tickets';

	protected $casts = [
		'category_id' => 'int',
		'user_id' => 'int',
		'is_answered' => 'bool',
		'is_resolved' => 'bool'
	];

	protected $fillable = [
		'category_id',
		'user_id',
		'title',
		'description',
		'file_url',
		'is_answered',
		'is_resolved'
	];

	public function category()
	{
		return $this->belongsTo(TicketCategory::class, 'category_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function ticket_messages()
	{
		return $this->hasMany(TicketMessage::class);
	}
}
