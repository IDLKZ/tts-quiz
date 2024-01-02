<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Reliese\Coders\Model\Relations\HasMany;

/**
 * Class Lesson
 *
 * @property int $id
 * @property int $course_id
 * @property string $alias
 * @property string $type
 * @property string $video_url
 * @property string|null $video_type
 * @property string $title
 * @property string $subtitle
 * @property string $description
 * @property int $order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $prev_id
 * @property int|null $next_id
 *
 * @property Course $course
 * @property Lesson|null $lesson
 * @property Collection|LessonLike[] $lesson_likes
 * @property Collection|Lesson[] $lessons
 *
 * @package App\Models
 */
class Lesson extends Model
{
	protected $table = 'lessons';
    use Upload;
	protected $casts = [
		'course_id' => 'int',
		'order' => 'int',
		'prev_id' => 'int',
		'next_id' => 'int'
	];

	protected $fillable = [
		'course_id',
		'alias',
		'type',
        'image_url',
		'video_url',
		'video_type',
		'title',
		'subtitle',
		'description',
		'order',
		'prev_id',
		'next_id'
	];

	public function course()
	{
		return $this->belongsTo(Course::class);
	}

	public function next_lesson()
	{
		return $this->belongsTo(Lesson::class, 'next_id',"id");
	}

	public function lesson_likes()
	{
		return $this->hasMany(LessonLike::class);
	}

	public function prev_lesson()
	{
		return $this->belongsTo(Lesson::class, 'prev_id',"id");
	}

    public function questions(){
        return $this->hasMany(Question::class, 'lesson_id',"id");
    }

    public function isPassed(){
        return PassedLesson::where(["user_id" => auth()->id(),"lesson_id"=>$this->id])->exists();
    }
}
