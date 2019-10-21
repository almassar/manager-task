<?php

namespace App\Modules\BusinessTrips;

use App\Modules\Repositories\Repository;

class BusinessTripRepository extends Repository
{
	public function model()
	{
		return BusinessTrip::class;
	}

}