<?php 
namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;
use App\Repositories\Contracts\PermissionRepositoryInterface;

class PermissionRepository extends Repository implements PermissionRepositoryInterface {
 
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\Permission';
    }
}