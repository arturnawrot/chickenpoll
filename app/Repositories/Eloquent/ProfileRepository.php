<?php 
namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;
use App\Repositories\Contracts\ProfileRepositoryInterface;

class ProfileRepository extends Repository implements ProfileRepositoryInterface {
 
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\Profile';
    }
}