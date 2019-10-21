<?php

namespace App\Modules\Organizations;

use App\Modules\Cities\CityScope;
use App\Modules\Notes\Note;
use App\Modules\Services\Service;
use App\Modules\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

/**
 * App\Modules\Organizations\Organization
 *
 * @property int $id
 * @property string $name
 * @property string|null $address
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\Users\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Organizations\Organization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Organizations\Organization newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Organizations\Organization query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Organizations\Organization whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Organizations\Organization whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Organizations\Organization whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Organizations\Organization whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Organizations\Organization whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Organizations\Organization whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $city_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\Services\Service[] $services
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Organizations\Organization whereCityId($value)
 */
class Organization extends Model
{
    use Notifiable;

    protected $fillable = ['name', 'address', 'city_id'];

     protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CityScope);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class)->latest();
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'organization_service')->withPivot('id', 'contract', 'price');
    }

    public function service_dates($organizationServiceId)
    {
        return DB::table('service_date')->where('organization_service_id', $organizationServiceId)->get();
    }
}
