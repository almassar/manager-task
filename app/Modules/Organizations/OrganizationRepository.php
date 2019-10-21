<?php

namespace App\Modules\Organizations;

use App\Modules\Repositories\Repository;

class OrganizationRepository extends Repository
{
	public function model()
	{
		return Organization::class;
	}

    public function search($name)
    {
        $organizations = Organization::query()->where('name', 'LIKE', "%{$name}%")->get();
        return $organizations;
    }

    public function save(array $data, $model = null)
    {
        $data['city_id'] = session('city_id');
        return parent::save($data, $model);
    }
}
