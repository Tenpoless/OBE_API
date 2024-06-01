<?php

namespace App\Providers;

use App\Repositories\CplRepository;
use App\Repositories\EvalRepository;
use App\Repositories\SubCpmkRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\DetailRpsRepository;
use App\Repositories\MatkulCplRepository;
use App\Interfaces\CplRepositoryInterface;
use App\Repositories\PengampuMkRepository;
use App\Interfaces\EvalRepositoryInterface;
use App\Interfaces\SubCpmkRepositoryInterface;
use App\Interfaces\DetailRpsRepositoryInterface;
use App\Interfaces\MatkulCplRepositoryInterface;
use App\Interfaces\PengampuMkRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(EvalRepositoryInterface::class, EvalRepository::class);
        $this->app->bind(DetailRpsRepositoryInterface::class, DetailRpsRepository::class);
        $this->app->bind(SubCpmkRepositoryInterface::class, SubCpmkRepository::class);
        $this->app->bind(PengampuMkRepositoryInterface::class, PengampuMkRepository::class);
        $this->app->bind(CplRepositoryInterface::class, CplRepository::class);
        $this->app->bind(MatkulCplRepositoryInterface::class, MatkulCplRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
