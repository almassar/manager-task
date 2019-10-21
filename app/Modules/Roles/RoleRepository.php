<?php

namespace App\Modules\Roles;

use App\Modules\Repositories\Repository;

class RoleRepository extends Repository
{
	public function model()
	{
		return Role::class;
	}

}