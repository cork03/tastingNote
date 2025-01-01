<?php

namespace App\Providers;

use App\gateways\repository\GrapeVarietyRepository;
use App\gateways\repository\GrapeVarietyRepositoryInterface;
use App\gateways\repository\ProducerRepository;
use App\gateways\repository\ProducerRepositoryInterface;
use App\usecase\grapeVariety\GetGrapeVarietiesUseCase;
use App\usecase\grapeVariety\GetGrapeVarietiesUseCaseInterface;
use App\usecase\producer\CreateProducerUseCase;
use App\usecase\producer\CreateProducerUseCaseInterface;
use App\usecase\producer\GetProducersUseCase;
use App\usecase\producer\GetProducersUseCaseInterface;
use App\usecase\producer\GetProducerWinesUseCase;
use App\usecase\producer\GetProducerWinesUseCaseInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CreateProducerUseCaseInterface::class, CreateProducerUseCase::class);
        $this->app->bind(ProducerRepositoryInterface::class, ProducerRepository::class);
        $this->app->bind(GetProducersUseCaseInterface::class, GetProducersUseCase::class);
        $this->app->bind(GetGrapeVarietiesUseCaseInterface::class, GetGrapeVarietiesUseCase::class);
        $this->app->bind(GrapeVarietyRepositoryInterface::class, GrapeVarietyRepository::class);
        $this->app->bind(GetProducerWinesUseCaseInterface::class, GetProducerWinesUseCase::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
