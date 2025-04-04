<?php

namespace App\Providers;

use App\usecase\appellation\AppellationCreateUseCase\AppellationCreateUseCase;
use App\usecase\appellation\AppellationCreateUseCase\AppellationCreateUseCaseInterface;
use App\usecase\appellation\GetAppellationsUsecase\GetAppellationsUseCase;
use App\usecase\appellation\GetAppellationsUsecase\GetAppellationsUseCaseInterface;
use App\usecase\appellation\GetAppellationTypesUseCase\GetAppellationTypesUseCase;
use App\usecase\appellation\GetAppellationTypesUseCase\GetAppellationTypesUseCaseInterface;
use App\usecase\blindTasting\BlindTastingCreateUseCase\BlindTastingCreateUseCase;
use App\usecase\blindTasting\BlindTastingCreateUseCase\BlindTastingCreateUseCaseInterface;
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
use App\usecase\wine\CreateWineUseCase\CreateWineUseCase;
use App\usecase\wine\CreateWineUseCase\CreateWineUseCaseInterface;
use App\usecase\wine\GetWineUseCase\GetWinesUseCase;
use App\usecase\wine\GetWineUseCase\GetWinesUseCaseInterface;
use App\usecase\wine\GetWineWithVintagesUseCase\GetWineWithVintagesUseCase;
use App\usecase\wine\GetWineWithVintagesUseCase\GetWineWithVintagesUseCaseInterface;
use App\usecase\wine\types\GetWineTypesUseCase;
use App\usecase\wine\types\GetWineTypesUseCaseInterface;
use App\usecase\wine\UpdateWineUseCase\UpdateWineUseCase;
use App\usecase\wine\UpdateWineUseCase\UpdateWineUseCaseInterface;
use App\usecase\wineComment\CreateWineCommentUseCase\CreateWineCommentUseCase;
use App\usecase\wineComment\CreateWineCommentUseCase\CreateWineCommentUseCaseInterface;
use App\usecase\wineComment\GetWineCommentUseCase\GetWineCommentUseCase;
use App\usecase\wineComment\GetWineCommentUseCase\GetWineCommentUseCaseInterface;
use App\usecase\wineComment\LinkWineCommentToWineVintageUseCase;
use App\usecase\wineComment\LinkWineCommentToWineVintageUseCaseInterface;
use App\usecase\wineComment\UpdateWineCommentUseCase\UpdateWineCommentUseCase;
use App\usecase\wineComment\UpdateWineCommentUseCase\UpdateWineCommentUseCaseInterface;
use App\usecase\wineRanking\GetWineRankingsUseCase;
use App\usecase\wineRanking\GetWineRankingsUseCaseInterface;
use App\usecase\wineRanking\WineRankingCreateUseCase;
use App\usecase\wineRanking\WineRankingCreateUseCaseInterface;
use App\usecase\wineVintage\CreateUseCase;
use App\usecase\wineVintage\CreateUseCaseInterface;
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
            AppellationCreateUseCaseInterface::class => AppellationCreateUseCase::class,
            BlindTastingCreateUseCaseInterface::class => BlindTastingCreateUseCase::class,
            CreateProducerUseCaseInterface::class => CreateProducerUseCase::class,
            CreateWineUseCaseInterface::class => CreateWineUseCase::class,
            CreateUseCaseInterface::class => CreateUseCase::class,
            CreateWineCommentUseCaseInterface::class => CreateWineCommentUseCase::class,
            CreateWineVintageAndLinkCommentUseCaseInterface::class => CreateWineVintageAndLinkCommentUseCase::class,
            EditWineVintageUseCaseInterface::class => EditWineVintageUseCase::class,
            GetAppellationTypesUseCaseInterface::class => GetAppellationTypesUseCase::class,
            GetAppellationsUseCaseInterface::class => GetAppellationsUseCase::class,
            GetCountriesUseCaseInterface::class => GetCountriesUseCase::class,
            GetFullInfoUseCaseInterface::class => GetFullInfoUseCase::class,
            GetGrapeVarietiesUseCaseInterface::class => GetGrapeVarietiesUseCase::class,
            GetNotRegisteredRankingWineVintagesUseCaseInterface::class => GetNotRegisteredRankingWineVintagesUseCase::class,
            GetProducersUseCaseInterface::class => GetProducersUseCase::class,
            GetProducerWinesUseCaseInterface::class => GetProducerWinesUseCase::class,
            GetProducerUseCaseInterface::class => GetProducerUseCase::class,
            GetWineCommentUseCaseInterface::class => GetWineCommentUseCase::class,
            GetWineCommentsUseCaseInterface::class => GetWineCommentsUseCase::class,
            GetWineTypesUseCaseInterface::class => GetWineTypesUseCase::class,
            GetWineVintageByIdUseCaseInterface::class => GetWineVintageByIdUseCase::class,
            GetWineWithVintagesUseCaseInterface::class => GetWineWithVintagesUseCase::class,
            GetWineRankingsUseCaseInterface::class => GetWineRankingsUseCase::class,
            GetWineVintagesByIdUseCaseInterface::class => GetWineVintagesByIdUseCase::class,
            GetWinesUseCaseInterface::class => GetWinesUseCase::class,
            LinkWineCommentToWineVintageUseCaseInterface::class => LinkWineCommentToWineVintageUseCase::class,
            UpdateWineCommentUseCaseInterface::class => UpdateWineCommentUseCase::class,
            UpdateWineUseCaseInterface::class => UpdateWineUseCase::class,
            WineRankingCreateUseCaseInterface::class => WineRankingCreateUseCase::class,
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
