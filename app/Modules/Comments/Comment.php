<?php

namespace App\Modules\Comments;

use App\Modules\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * App\Modules\Comments\Comment
 *
 * @property int $id
 * @property int $task_id
 * @property int $user_id
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\Modules\Users\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Comments\Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Comments\Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Comments\Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Comments\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Comments\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Comments\Comment whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Comments\Comment whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Comments\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Comments\Comment whereUserId($value)
 * @mixin \Eloquent
 */
class Comment extends Model
{
    use Notifiable;
    protected $fillable = ['task_id', 'user_id', 'message'];


    public function getCreatedAtAttribute($value) {
        return Carbon::parse($value)->format('d.m.Y');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
