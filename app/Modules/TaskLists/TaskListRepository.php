<?php

namespace App\Modules\TaskLists;

use App\Modules\Repositories\Repository;

class TaskListRepository extends Repository
{
	public function model()
	{
		return TaskList::class;
	}

}