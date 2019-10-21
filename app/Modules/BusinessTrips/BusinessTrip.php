<?php

namespace App\Modules\BusinessTrips;

use App\Modules\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BusinessTrip extends Model
{
    use Notifiable;
    protected $fillable = ['date_begin', 'date_end', 'user_id', 'object', 'locate'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDateBeginAttribute($value)
    {
        return date('d.m.Y', strtotime($value));
    }

    public function setDateBeginAttribute($value)
    {
        $this->attributes['date_begin'] = date('Y-m-d', strtotime($value));
    }

    public function getDateEndAttribute($value)
    {
        return date('d.m.Y', strtotime($value));
    }

    public function setDateEndAttribute($value)
    {
        $this->attributes['date_end'] = date('Y-m-d', strtotime($value));
    }
}
