<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TicketMessage
 *
 * @property int $id
 * @property int $ticket_id
 * @property int $user_id
 * @property string $message
 * @property string|null $file_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Ticket $ticket
 * @property User $user
 *
 * @package App\Models
 */
class TicketMessage extends Model
{
    use Upload;

    protected $table = 'ticket_messages';

	protected $casts = [
		'ticket_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'ticket_id',
		'user_id',
		'message',
		'file_url'
	];

	public function ticket()
	{
		return $this->belongsTo(Ticket::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
