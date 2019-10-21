<?php

namespace App\Modules\Roles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * App\Modules\Roles\Role
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Roles\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Roles\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Roles\Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Roles\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Roles\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Roles\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Roles\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends Model
{
    use Notifiable;
    protected $fillable = ['name'];
}
