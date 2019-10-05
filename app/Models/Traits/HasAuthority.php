<?php

namespace App\Models\Traits;

use App\Models\Role;

trait HasAuthority
{
    public function isMoreImportant(Role $role)
    {
        return $this->authority > $role->authority;
    }
}
