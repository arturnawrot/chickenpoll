<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;
use App\Repositories\Contracts\OptionRepositoryInterface;
use App\Repositories\Eloquent\Traits\Sortable;

class OptionRepository extends Repository implements OptionRepositoryInterface {

    use Sortable;

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\Option';
    }

}