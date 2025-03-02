<?php

namespace App\Providers;

use App\usecase\appellation\AppellationCreateUseCase;
use App\usecase\appellation\AppellationCreateUseCaseInterface;
use App\usecase\appellation\GetAppellationsUseCase;
use App\usecase\appellation\GetAppellationsUseCaseInterface;
use App\usecase\appellation\GetAppellationTypesUseCase;
use App\usecase\appellation\GetAppellationTypesUseCaseInterface;
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
use App\usecase\producer\GetProducerUseCase;
use App\usecase\producer\GetProducerUseCaseInterface;
use App\usecase\producer\GetProducerWinesUseCase\GetProducerWinesUseCase;
use App\usecase\producer\GetProducerWinesUseCase\GetProducerWinesUseCaseInterface;
use App\usecase\wine\CreateWineUseCase;
use App\usecase\wine\CreateWineUseCaseInterface;
use App\usecase\wine\GetWineUseCase\GetWinesUseCase;
use App\usecase\wine\GetWineUseCase\GetWinesUseCaseInterface;
use App\usecase\wine\GetWineWithVintagesUseCase;
use App\usecase\wine\GetWineWithVintagesUseCaseInterface;
use App\usecase\wine\types\GetWineTypesUseCase;
use App\usecase\wine\types\GetWineTypesUseCaseInterface;
use App\usecase\wineComment\LinkWineCommentToWineVintageUseCase;
use App\usecase\wineComment\LinkWineCommentToWineVintageUseCaseInterface;
use App\usecase\wineRanking\GetWineRankingsUseCase;
use App\usecase\wineRanking\GetWineRankingsUseCaseInterface;
use App\usecase\wineRanking\WineRankingCreateUseCase;
use App\usecase\wineRanking\WineRankingCreateUseCaseInterface;
use App\usecase\wineVintage\CreateUseCase;
use App\usecase\wineVintage\CreateUseCaseInterface;
use App\usecase\wineVintage\CreateWineCommentUseCase;
use App\usecase\wineVintage\CreateWineCommentUseCaseInterface;
use App\usecase\wineVintage\CreateWineVintageAndLinkCommentUseCase;
use App\usecase\wineVintage\CreateWineVintageAndLinkCommentUseCaseInterface;
use App\usecase\wineVintage\EditWineVintageUseCase;
use App\usecase\wineVintage\EditWineVintageUseCaseInterface;
use App\usecase\wineVintage\GetFullInfoUseCase;
use App\usecase\wineVintage\GetFullInfoUseCaseInterface;
use App\usecase\wineVintage\GetNotRegisteredRankingWineVintagesUseCase;
use App\usecase\wineVintage\GetNotRegisteredRankingWineVintagesUseCaseInterface;
use App\usecase\wineVintage\GetWineCommentsUseCase;
use App\usecase\wineVintage\GetWineCommentsUseCaseInterface;
use App\usecase\wineVintage\GetWineVintageByIdUseCase;
use App\usecase\wineVintage\GetWineVintageByIdUseCaseInterface;
use App\usecase\wineVintage\GetWineVintagesByIdUseCase;
use App\usecase\wineVintage\GetWineVintagesByIdUseCaseInterface;
use Illuminate\Support\ServiceProvider;

class UseCaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $bindings = [
            GetAppellationTypesUseCaseInterface::class => GetAppellationTypesUseCase::class,
            CreateProducerUseCaseInterface::class => CreateProducerUseCase::class,
            GetProducersUseCaseInterface::class => GetProducersUseCase::class,
            GetGrapeVarietiesUseCaseInterface::class => GetGrapeVarietiesUseCase::class,
            GetProducerWinesUseCaseInterface::class => GetProducerWinesUseCase::class,
            CreateWineUseCaseInterface::class => CreateWineUseCase::class,
            GetCountriesUseCaseInterface::class => GetCountriesUseCase::class,
            CreateUseCaseInterface::class => CreateUseCase::class,
            GetWineTypesUseCaseInterface::class => GetWineTypesUseCase::class,
            GetWinesUseCaseInterface::class => GetWinesUseCase::class,
            GetWineWithVintagesUseCaseInterface::class => GetWineWithVintagesUseCase::class,
            GetFullInfoUseCaseInterface::class => GetFullInfoUseCase::class,
            BlindTastingCreateUsecaseInterface::class => BlindTastingCreateUsecase::class,
            CreateWineCommentUseCaseInterface::class => CreateWineCommentUseCase::class,
            GetProducerUseCaseInterface::class => GetProducerUseCase::class,
            GetWineCommentsUseCaseInterface::class => GetWineCommentsUseCase::class,
            CreateWineVintageAndLinkCommentUseCaseInterface::class => CreateWineVintageAndLinkCommentUseCase::class,
            GetWineVintageByIdUseCaseInterface::class => GetWineVintageByIdUseCase::class,
            EditWineVintageUseCaseInterface::class => EditWineVintageUseCase::class,
            GetWineVintagesByIdUseCaseInterface::class => GetWineVintagesByIdUseCase::class,
            LinkWineCommentToWineVintageUseCaseInterface::class => LinkWineCommentToWineVintageUseCase::class,
            WineRankingCreateUseCaseInterface::class => WineRankingCreateUseCase::class,
            GetWineRankingsUseCaseInterface::class => GetWineRankingsUseCase::class,
            GetNotRegisteredRankingWineVintagesUseCaseInterface::class => GetNotRegisteredRankingWineVintagesUseCase::class,
            AppellationCreateUseCaseInterface::class => AppellationCreateUseCase::class,
            GetAppellationsUseCaseInterface::class => GetAppellationsUseCase::class,
        ];
        foreach ($bindings as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
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
