<?php

namespace App\Modules\Journals;

use App\Modules\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


/**
 * App\Modules\Journals\Journal
 *
 * @property int $id
 * @property int $user_id
 * @property string $date
 * @property string $locate
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\Modules\Users\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Journals\Journal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Journals\Journal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Journals\Journal query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Journals\Journal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Journals\Journal whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Journals\Journal whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Journals\Journal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Journals\Journal whereLocate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Journals\Journal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Journals\Journal whereUserId($value)
 * @mixin \Eloquent
 */
class Journal extends Model
{
    use Notifiable;
    protected $fillable = ['locate', 'date', 'user_id', 'object'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDateAttribute($value)
    {
        return date('d.m.Y', strtotime($value));
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = date('Y-m-d', strtotime($value));
    }

    public function getLocate($date)
    {
        $date = date('Y-m-d', strtotime($date));

        return $this->where([['date',  $date], ['user_id',  $this->user_id]])->first();
    }
}
