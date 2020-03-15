<?php

namespace App\Http\View\Composers;

use Wink\WinkPost as Post;
use Illuminate\View\View;

class PostComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $posts;

    /**
     * Create a new profile composer.
     *
     * @param  PermissionRepositoryInterface  $permissions
     * @return void
     */
    public function __construct(Post $post)
    {
        // Dependencies automatically resolved by service container...
        $this->posts = $post;
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
            'posts', $this->posts->orderBy('created_at', 'DESC')->paginate(20)
        );
    }
}
