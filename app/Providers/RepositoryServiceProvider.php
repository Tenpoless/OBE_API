<?php

namespace App\Providers;

use App\Repositories\EvalRepository;
use App\Repositories\EvalMhsRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\HalUtamaRepository;
use App\Interfaces\EvalRepositoryInterface;
use App\Interfaces\EvalMhsRepositoryInterface;
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
        $this->app->bind(EvalMhsRepositoryInterface::class, EvalMhsRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
