<?php

namespace App\Repositories\Eloquent\Traits;

trait Sortable
{
    public function sortable()
    {
        return $this->model->sortable();
    }
}