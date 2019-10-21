<?php

namespace App\Modules\Users;

use App\Modules\Repositories\Repository;

class UserRepository extends Repository
{
	public function model()
	{
		return User::class;
	}

    public function search($name)
    {
        $users = User::query()->where('name', 'LIKE', "%{$name}%")->get();
        return $users;
    }

}