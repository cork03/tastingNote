<?php

namespace App\Providers;

use App\gateways\repository\CountryRepository;
use App\gateways\repository\CountryRepositoryInterface;
use App\gateways\repository\GrapeVarietyRepository;
use App\gateways\repository\GrapeVarietyRepositoryInterface;
use App\gateways\repository\ProducerRepository;
use App\gateways\repository\ProducerRepositoryInterface;
use App\gateways\repository\wine\wineTypes\WineTypesRepository;
use App\gateways\repository\wine\wineTypes\WineTypesRepositoryInterface;
use App\gateways\repository\WineRepository;
use App\gateways\repository\WineRepositoryInterface;
use App\gateways\repository\WineVintageRepository;
use App\gateways\repository\WineVintageRepositoryInterface;
use App\usecase\country\GetCountriesUseCase;
use App\usecase\country\GetCountriesUseCaseInterface;
use App\usecase\grapeVariety\GetGrapeVarietiesUseCase;
use App\usecase\grapeVariety\GetGrapeVarietiesUseCaseInterface;
use App\usecase\producer\CreateProducerUseCase;
use App\usecase\producer\CreateProducerUseCaseInterface;
use App\usecase\producer\GetProducersUseCase;
use App\usecase\producer\GetProducersUseCaseInterface;
use App\usecase\producer\GetProducerWinesUseCase;
use App\usecase\producer\GetProducerWinesUseCaseInterface;
use App\usecase\wine\CreateWineUseCase;
use App\usecase\wine\CreateWineUseCaseInterface;
use App\usecase\wine\CreateWineVintageUseCase;
use App\usecase\wine\CreateWineVintageUseCaseInterface;
use App\usecase\wine\GetWinesUseCase;
use App\usecase\wine\GetWinesUseCaseInterface;
use App\usecase\wine\types\GetWineTypesUseCase;
use App\usecase\wine\types\GetWineTypesUseCaseInterface;
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
        $this->app->bind(CreateWineUseCaseInterface::class, CreateWineUseCase::class);
        $this->app->bind(WineRepositoryInterface::class, WineRepository::class);
        $this->app->bind(GetCountriesUseCaseInterface::class, GetCountriesUseCase::class);
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->bind(CreateWineVintageUseCaseInterface::class, CreateWineVintageUseCase::class);
        $this->app->bind(WineVintageRepositoryInterface::class, WineVintageRepository::class);
        $this->app->bind(GetWineTypesUseCaseInterface::class, GetWineTypesUseCase::class);
        $this->app->bind(WineTypesRepositoryInterface::class, WineTypesRepository::class);
        $this->app->bind(GetWinesUseCaseInterface::class, GetWinesUseCase::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
