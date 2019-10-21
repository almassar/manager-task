<?php

namespace App\Modules\Notes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * App\Modules\Notes\Note
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Notes\Note newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Notes\Note newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Notes\Note query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Notes\Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Notes\Note whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Notes\Note whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Notes\Note whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Note extends Model
{
    use Notifiable;
    protected $guarded = [];
}
