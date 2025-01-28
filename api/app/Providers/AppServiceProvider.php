<?php

namespace App\Providers;

use App\gateways\repository\blindTasting\BlindTastingRepository;
use App\gateways\repository\blindTasting\BlindTastingRepositoryInterface;
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
use App\gateways\repository\wineVintage\WineCommentRepository;
use App\gateways\repository\wineVintage\WineCommentRepositoryInterface;
use App\gateways\repository\WineVintageRepository;
use App\gateways\repository\WineVintageRepositoryInterface;
use App\usecase\blindTasting\BlindTastingCreateUsecase;
use App\usecase\blindTasting\BlindTastingCreateUsecaseInterface;
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
use App\usecase\wine\GetWinesUseCase;
use App\usecase\wine\GetWinesUseCaseInterface;
use App\usecase\wine\GetWineWithVintagesUseCase;
use App\usecase\wine\GetWineWithVintagesUseCaseInterface;
use App\usecase\wine\types\GetWineTypesUseCase;
use App\usecase\wine\types\GetWineTypesUseCaseInterface;
use App\usecase\wineVintage\CreateUseCase;
use App\usecase\wineVintage\CreateUseCaseInterface;
use App\usecase\wineVintage\CreateWineCommentUseCase;
use App\usecase\wineVintage\CreateWineCommentUseCaseInterface;
use App\usecase\wineVintage\GetFullInfoUseCase;
use App\usecase\wineVintage\GetFullInfoUseCaseInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $bindings = [
            CreateProducerUseCaseInterface::class => CreateProducerUseCase::class,
            ProducerRepositoryInterface::class => ProducerRepository::class,
            GetProducersUseCaseInterface::class => GetProducersUseCase::class,
            GetGrapeVarietiesUseCaseInterface::class => GetGrapeVarietiesUseCase::class,
            GrapeVarietyRepositoryInterface::class => GrapeVarietyRepository::class,
            GetProducerWinesUseCaseInterface::class => GetProducerWinesUseCase::class,
            CreateWineUseCaseInterface::class => CreateWineUseCase::class,
            WineRepositoryInterface::class => WineRepository::class,
            GetCountriesUseCaseInterface::class => GetCountriesUseCase::class,
            CountryRepositoryInterface::class => CountryRepository::class,
            CreateUseCaseInterface::class => CreateUseCase::class,
            WineVintageRepositoryInterface::class => WineVintageRepository::class,
            GetWineTypesUseCaseInterface::class => GetWineTypesUseCase::class,
            WineTypesRepositoryInterface::class => WineTypesRepository::class,
            GetWinesUseCaseInterface::class => GetWinesUseCase::class,
            GetWineWithVintagesUseCaseInterface::class => GetWineWithVintagesUseCase::class,
            GetFullInfoUseCaseInterface::class => GetFullInfoUseCase::class,
            BlindTastingCreateUsecaseInterface::class => BlindTastingCreateUsecase::class,
            BlindTastingRepositoryInterface::class => BlindTastingRepository::class,
            CreateWineCommentUseCaseInterface::class => CreateWineCommentUseCase::class,
            WineCommentRepositoryInterface::class => WineCommentRepository::class,
        ];

        foreach ($bindings as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
