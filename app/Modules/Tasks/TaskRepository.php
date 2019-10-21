<?php

namespace App\Modules\Tasks;

use App\Modules\Repositories\Repository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TaskRepository extends Repository
{
	public function model()
	{
		return Task::class;
	}

    public function save(array $data, $model = null)
    {
        $data['city_id'] = session('city_id');
        return parent::save($data, $model);
    }

    public function getTaskForMe(): Builder
    {
        $tasks = Task::whereHas('executers' , function (Builder $query) {
                    $query->where('task_executer.user_id', '=', Auth::user()->id);
                 })->where([ ['is_finish', '=', 0], ['date_execute', '<=', date('Y-m-d')]])->orderBy('date_execute', 'asc');

        return $tasks;
    }

    public function search($searchWord)
    {
        $tasks = Task::where('name', 'LIKE', "%{$searchWord}%")->orderBy('is_finish', 'asc')->paginate();
        return $tasks;
    }


}