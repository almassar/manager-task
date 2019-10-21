<?php

namespace App\Modules\Users;

use App\Modules\Organizations\Organization;
use App\Modules\Roles\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use NotificationChannels\WebPush\HasPushSubscriptions;

/**
 * App\Modules\Users\User
 *
 * @method static \Illuminate\Database\Eloquent\Builder|User where($column, $value)
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property int $role_id
 * @property int|null $city_id Только для сотрудников
 * @property int|null $organization_id
 * @property string|null $mobile_phone
 * @property int $is_client
 * @property string|null $deleted_at
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read Organization|null $organization
 * @property-read Role $role
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Users\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Users\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Users\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Users\User whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Users\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Users\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Users\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Users\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Users\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Users\User whereIsClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Users\User whereMobilePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Users\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Users\User whereOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Users\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Users\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Users\User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Users\User whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, HasPushSubscriptions;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile_phone', 'role_id', 'organization_id', 'is_client'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function shortName()
    {
        $array = explode(' ', $this->name);

        return $array[0].'.'.mb_substr($array[1], 0, 1);
    }
}
