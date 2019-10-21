<?php

namespace App\Modules\TaskLists;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * App\Modules\TaskLists\TaskList
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\TaskLists\TaskList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\TaskLists\TaskList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\TaskLists\TaskList query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\TaskLists\TaskList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\TaskLists\TaskList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\TaskLists\TaskList whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\TaskLists\TaskList whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TaskList extends Model
{
    use Notifiable;
    protected $fillable = ['name'];
}
