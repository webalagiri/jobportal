<?php

namespace App\jobportal\serviceproviders\reposerviceprovider;

use Illuminate\Support\ServiceProvider;

class PortalRepoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\jobportal\repositories\repointerface\HelperInterface',
            'App\jobportal\repositories\repoimpl\HelperImpl');
        $this->app->bind('App\jobportal\repositories\repointerface\CompanyInterface',
            'App\jobportal\repositories\repoimpl\CompanyImpl');
    }
}
