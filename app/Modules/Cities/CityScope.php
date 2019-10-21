<?php


namespace App\Modules\Cities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CityScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('city_id', '=', session('city_id'));
    }
}