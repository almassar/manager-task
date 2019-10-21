<?php

namespace App\Modules\Cities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * App\Modules\Cities\City
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Cities\City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Cities\City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Cities\City query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Cities\City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Cities\City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Cities\City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Cities\City whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class City extends Model
{
    use Notifiable;

    protected $fillable = ['name'];
}
