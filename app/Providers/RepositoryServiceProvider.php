<?php

namespace App\Providers;

use App\Repositories\EvalRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\HalUtamaRepository;
use App\Interfaces\EvalRepositoryInterface;
use App\Interfaces\HalUtamaRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(EvalRepositoryInterface::class, EvalRepository::class);
        $this->app->bind(HalUtamaRepositoryInterface::class, HalUtamaRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
