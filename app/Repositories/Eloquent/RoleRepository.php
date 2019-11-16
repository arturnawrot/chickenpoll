<?php 
namespace App\Repositories\Eloquent;
 
use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;
use App\Repositories\Contracts\RoleRepositoryInterface;

class RoleRepository extends Repository implements RoleRepositoryInterface {
 
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\Role';
    }

    public function countUsers($rank)
    {
        return $this->showUsers()->count();
    }

    public function showUsers($rank)
    {
        return $this->model->users();
    }
}