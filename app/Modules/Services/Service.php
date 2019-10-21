<?php

namespace App\Modules\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * App\Modules\Services\Service
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property int $service_group_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Services\Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Services\Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Services\Service query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Services\Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Services\Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Services\Service whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Services\Service wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Services\Service whereServiceGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Services\Service whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Service extends Model
{
    use Notifiable;

    protected $fillable = ['name', 'service_group_id'];



}
