<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;
use App\Repositories\Contracts\AnswerRepositoryInterface;
use App\Repositories\Eloquent\Traits\Sortable;

class AnswerRepository extends Repository implements AnswerRepositoryInterface {

    use Sortable;

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\Answer';
    }

}