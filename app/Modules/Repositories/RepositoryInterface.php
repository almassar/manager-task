<?php

namespace App\Modules\Repositories;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
	public function save(array $data, Model $model = null);

    public function delete($id);

    public function all(array $columns = ['*']);

    public function paginate($perPage = 15, array $columns = ['*']);

    public function find($id, array $columns = ['*']);

    public function orderBy($column, $direction = 'asc');

    public function where(array $filter = []);
}
