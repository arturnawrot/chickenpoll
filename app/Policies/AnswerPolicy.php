<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

// Voting policy
class ResponsePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user, Response $Response)
    {

    }
}
