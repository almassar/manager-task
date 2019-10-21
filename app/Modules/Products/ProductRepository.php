<?php

namespace App\Modules\Products;

use App\Modules\Repositories\Repository;

class ProductRepository extends Repository
{
	public function model()
	{
		return Product::class;
	}

}