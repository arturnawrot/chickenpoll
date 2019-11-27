<?php 
namespace App\Repositories\Eloquent;
 
use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\Traits\Sortable;

class UserRepository extends Repository implements UserRepositoryInterface {
 
    use Sortable;

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\User';
    }

}