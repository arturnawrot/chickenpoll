<?php

namespace App\Http\View\Composers;

use App\Models\Poll as Poll;
use Illuminate\View\View;

class PollComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $polls;

    /**
     * Create a new profile composer.
     *
     * @param  PermissionRepositoryInterface  $permissions
     * @return void
     */
    public function __construct(Poll $polls)
    {
        // Dependencies automatically resolved by service container...
        $this->polls = $polls;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with(
            'polls', $this->polls->withCount('votes')->sortable()->paginate(20)
        );
    }
}