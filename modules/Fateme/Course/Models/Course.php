<?php

namespace Fateme\Course\Models;

use Fateme\Category\Models\Category;
use Fateme\Course\Repositories\CourseRepo;
use Fateme\Media\Models\Media;
use Fateme\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];
    const TYPE_FREE = 'free';
    const TYPE_CASH = 'cash';

    public static $types = [self::TYPE_FREE, self::TYPE_CASH];

    const STATUS_COMPLETED = 'completed';

    const STATUS_NOT_COMPLETED = 'not-completed';

    const STATUS_LOCKED = 'locked';

    public static $statuses = [self::STATUS_COMPLETED, self::STATUS_NOT_COMPLETED, self::STATUS_LOCKED];

    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';

    const CONFIRMATION_STATUS_REJECTED = 'rejected';

    const CONFIRMATION_STATUS_PENDING = 'pending';

    public static $confirmationStatuses = [self::CONFIRMATION_STATUS_ACCEPTED, self::CONFIRMATION_STATUS_PENDING, self::CONFIRMATION_STATUS_REJECTED];


    public function banner()
    {
        return $this->belongsTo(Media::class, 'banner_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function getDuration()
    {
        return (new CourseRepo())->getDuration($this->id);
    }
    public function formattedDuration()
    {
        $duration =  $this->getDuration();
        $h  =round($duration / 60) < 10 ? '0' .  round($duration / 60) :  round($duration / 60);
        $m = ($duration % 60) < 10 ? '0' . ($duration % 60) : ($duration % 60);
        return $h . ':' . $m . ":00";
    }

    public function getFormattedPrice()
    {
        return number_format($this->price);
    }
    public function path()
    {
        return route('singleCourse', $this->id . '-' . $this->slug);
    }
}
