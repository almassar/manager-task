<?php

namespace App\Modules\ServiceGroups;

use App\Modules\Repositories\Repository;

class ServiceGroupRepository extends Repository
{
	public function model()
	{
		return ServiceGroup::class;
	}
}
