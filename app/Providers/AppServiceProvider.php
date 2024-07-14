<?php

namespace App\Providers;

use App\Repositories\Role\IRoleRepository;
use App\Repositories\Role\RoleRepository;
use App\Services\Role\IRoleService;
use App\Services\Role\RoleService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IRoleRepository::class,RoleRepository::class);
        $this->app->bind(IRoleService::class,RoleService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
