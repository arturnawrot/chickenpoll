<?php 
namespace App\Repositories\Eloquent;
 
use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;
use App\Repositories\Contracts\ShortlinkRepositoryInterface;
use App\Repositories\Eloquent\Traits\Sortable;

class ShortlinkRepository extends Repository implements ShortlinkRepositoryInterface {

    use Sortable;

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\Shortlink';
    }

}