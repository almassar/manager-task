<?php

namespace App\Modules\ProductGroups;

use App\Modules\Repositories\Repository;

class ProductGroupRepository extends Repository
{
	public function model()
	{
		return ProductGroup::class;
	}

}