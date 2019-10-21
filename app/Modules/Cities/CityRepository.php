<?php

namespace App\Modules\Cities;

use App\Modules\Repositories\Repository;

class CityRepository extends Repository
{
	public function model()
	{
		return City::class;
	}

}