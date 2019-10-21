<?php

namespace App\Modules\Services;

use App\Modules\Repositories\Repository;

class ServiceRepository extends Repository
{
	public function model()
	{
		return Service::class;
	}
}
