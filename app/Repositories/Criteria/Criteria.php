<?php 

namespace App\Repositories\Criteria;
 
use App\Repositories\Contracts\RepositoryInterface as Repository;
 
abstract class Criteria {
 
    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public abstract function apply($model, Repository $repository);
}