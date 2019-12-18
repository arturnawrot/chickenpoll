<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Poll;

class PollPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Poll $poll)
    {
        return $user->hasPermissionTo('poll.view');
    }

    public function update(User $user, Poll $poll)
    {
        return $user->hasPermissionTo('poll.update');
    }

    public function delete(User $user, Poll $poll)
    {
        return $user->hasPermissionTo('poll.delete');
    }
}
