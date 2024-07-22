<?php

namespace App\Repositories;

use App\Repositories\Contracts\DashboardRepositoryInterface;
use App\Repositories\Eloquent\DashboardRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(DashboardRepositoryInterface::class, DashboardRepository::class);
    }

    public function boot()
    {
        //
    }
}
