<?php

namespace App\Modules\ServiceGroups;

use App\Modules\Services\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


/**
 * App\Modules\ServiceGroups\ServiceGroup
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\Services\Service[] $services
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\ServiceGroups\ServiceGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\ServiceGroups\ServiceGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\ServiceGroups\ServiceGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\ServiceGroups\ServiceGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\ServiceGroups\ServiceGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\ServiceGroups\ServiceGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\ServiceGroups\ServiceGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ServiceGroup extends Model
{
    use Notifiable;

    protected $fillable = ['name'];

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
