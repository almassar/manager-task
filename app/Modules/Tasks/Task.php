<?php

namespace App\Modules\Tasks;

use App\Modules\Cities\CityScope;
use App\Modules\Comments\Comment;
use App\Modules\Users\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;


/**
 * App\Modules\Tasks\Task
 *
 * @property int $id
 * @property string $name
 * @property string $date_execute
 * @property int $is_finish
 * @property int $user_id
 * @property int $creater_id
 * @property int|null $claim_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $status
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\Modules\Users\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tasks\Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tasks\Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tasks\Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tasks\Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tasks\Task whereDateExecute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tasks\Task where($column, $operand, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tasks\Task whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tasks\Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tasks\Task whereIsFinish($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tasks\Task whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tasks\Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tasks\Task whereUserId($value)
 * @property string|null $description
 * @property int|null $executer_id
 * @property int|null $task_list_id
 * @property int $city_id
 * @property-read \Illuminate\Database\Eloquent\Collection|Comment[] $comments
 * @property-read \App\Modules\Users\User|null $creater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\Users\User[] $executers
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tasks\Task whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tasks\Task whereCreaterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tasks\Task whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tasks\Task whereExecuterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Tasks\Task whereTaskListId($value)
 */

class Task extends Model
{
    use Notifiable;

    protected $fillable = ['name', 'date_execute', 'user_id', 'claim_id', 'is_finish', 'city_id', 'task_list_id', 'creater_id', 'description'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CityScope);
    }

    public function getDateExecuteAttribute($value)
    {
        return date('d.m.Y', strtotime($value));
    }

     public function dateCreate()
    {
        return date('d.m.Y', strtotime($this->created_at));
    }

    public function setDateExecuteAttribute($value)
    {
        $this->attributes['date_execute'] = date('Y-m-d', strtotime($value));
    }

    public function getStatusAttribute()
    {
        return $this->is_finish ? 'Выполнено' : 'Работе';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creater()
    {
        return $this->belongsTo(User::class, 'creater_id', 'id');
    }

    public function executers()
    {
        return $this->belongsToMany(User::class, 'task_executer');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function getByDate($day, $monthId, $yearId)
    {
        if ($day == null)
            return collect();

        return self::whereIsFinish(0)->where('date_execute', Carbon::create($yearId, $monthId, $day))->get();
    }

    public function isOverdue()
    {
        return time() >= strtotime($this->date_execute);
    }

    /**
     * @return \Illuminate\Support\Collection/ \User
     */
    public function members()
    {
        $result = collect();

        $result->add($this->user);
        $result->add($this->creater);
        $result->merge($this->executers);

        foreach ($this->comments as $comment){
            $result->add($comment->user);
        }

        $result = $result->unique();
        $result = $result->whereNotIn('id', [Auth::user()->id]);

        return $result;
    }
}
