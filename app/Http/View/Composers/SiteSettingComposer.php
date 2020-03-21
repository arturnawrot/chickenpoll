<?php

namespace App\Http\View\Composers;

use App\Models\SiteSetting;
use Illuminate\View\View;

class SiteSettingComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $sitesettings;

    /**
     * Create a new profile composer.
     *
     * @param  PermissionRepositoryInterface  $permissions
     * @return void
     */
    public function __construct(SiteSetting $sitesetting)
    {
        // Dependencies automatically resolved by service container...
        $this->sitesettings = $sitesetting;
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
            'sitesettings', $this->sitesettings
        );
    }
}
