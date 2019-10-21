<?php

namespace App\Modules\Repositories;

use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

abstract class Repository implements RepositoryInterface
{
	protected $app;

	/** @var Model */
	protected $model;

    /**
     * @return Model
     */
	abstract public function model();

    /**
     * Repository constructor.
     * @param App $app
     */
    public function __construct(App $app)
	{
		$this->app = $app;
		$this->makeModel();
	}

    /**
     * @return Model
     */
	public function makeModel()
	{
		$model = $this->app->make($this->model());
		return $this->model = $model;
	}

    /**
     * @param array $data
     * @param Model $model
     * @return mixed
     */
    public function save(array $data, Model $model = null)
	{
		if ($model === null)
			return $this->model->create($data);

		$data = Arr::only($data, $this->model->getFillable());

		$model->fill($data);
		$model->save();

		return $model;
	}

	public function delete($id)
	{
		return $this->model->destroy($id);
	}

    /**
     * Получает все записи
     *
     * @param array $columns
     * @return Collection
     */
	public function all(array $columns = ['*'])
	{
		return $this->model->get($columns);
	}

	public function paginate($perPage = 15, array $columns = ['*'])
	{
        return $this->model->paginate($perPage, $columns);
    }

    public function find($id, array $columns = ['*'])
	{
		return $this->model->find($id, $columns);
	}

	#todo этот метод не нужен лучше наверное сделать критерии
     /**
     * Условие выборки
     *
     * @param array $filter
     * @return Builder
     */
	public function where(array $filter = [])
    {
        $this->makeModel();
        $this->model = $this->model->where($filter);
        //return $this;
        return $this->model->where($filter);
    }

    public function whereIn($column, array $data = [])
    {
        $this->makeModel();
       // $this->model = $this->model->whereIn($column, $data);

        return $this->model->whereIn($column, $data);
    }

	public function orderBy($column, $direction = 'asc')
    {
        $this->model = $this->model->orderBy($column, $direction = 'asc');
        return $this;
    }
}