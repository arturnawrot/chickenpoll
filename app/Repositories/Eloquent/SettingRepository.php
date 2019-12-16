<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;
use App\Repositories\Contracts\SettingRepositoryInterface;
use App\Repositories\Eloquent\Traits\Sortable;

class SettingRepository extends Repository implements SettingRepositoryInterface {

    use Sortable;

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\Setting';
    }

}