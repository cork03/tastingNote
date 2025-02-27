<?php

namespace App\Providers;

use App\gateways\queryService\CreateWineUseCaseQueryService;
use App\gateways\queryService\GetAppellationsUseCaseQueryService;
use App\gateways\queryService\GetAppellationTypesQueryService;
use App\gateways\queryService\GetWinesUseCaseQueryService;
use App\interfaceAdapter\queryService\CreateWineUseCaseQueryServiceInterface;
use App\interfaceAdapter\queryService\GetAppellationsUseCaseQueryServiceInterface;
use App\interfaceAdapter\queryService\GetAppellationTypesQueryServiceInterface;
use App\interfaceAdapter\queryService\GetWinesUseCaseQueryServiceInterface;
use Illuminate\Support\ServiceProvider;

class QueryServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $bindings = [
            CreateWineUseCaseQueryServiceInterface::class => CreateWineUseCaseQueryService::class,
            GetAppellationTypesQueryServiceInterface::class => GetAppellationTypesQueryService::class,
            GetAppellationsUseCaseQueryServiceInterface::class => GetAppellationsUseCaseQueryService::class,
            GetWinesUseCaseQueryServiceInterface::class => GetWinesUseCaseQueryService::class,
        ];

        foreach ($bindings as $interface => $concrete) {
            $this->app->bind($interface, $concrete);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
