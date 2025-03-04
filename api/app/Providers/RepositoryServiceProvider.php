<?php

namespace App\Providers;

use App\gateways\repository\AppellationRepository;
use App\gateways\repository\AppellationTypeRepository;
use App\gateways\repository\BlindTastingAnswerRepository;
use App\gateways\repository\CountryRepository;
use App\gateways\repository\CountryRepositoryInterface;
use App\gateways\repository\GrapeVarietyRepository;
use App\gateways\repository\GrapeVarietyRepositoryInterface;
use App\gateways\repository\ProducerRepository;
use App\gateways\repository\ProducerRepositoryInterface;
use App\gateways\repository\Transaction;
use App\gateways\repository\wine\wineTypes\WineTypesRepository;
use App\gateways\repository\wine\wineTypes\WineTypesRepositoryInterface;
use App\gateways\repository\WineCommentRepository;
use App\gateways\repository\wineRanking\WineRankingRepository;
use App\gateways\repository\wineRanking\WineRankingRepositoryInterface;
use App\gateways\repository\WineRepository;
use App\gateways\repository\WineVintageRepository;
use App\gateways\repository\WineVintageRepositoryInterface;
use App\interfaceAdapter\repository\AppellationRepositoryInterface;
use App\interfaceAdapter\repository\AppellationTypeRepositoryInterface;
use App\interfaceAdapter\repository\BlindTastingAnswerRepositoryInterface;
use App\interfaceAdapter\repository\TransactionInterface;
use App\interfaceAdapter\repository\WineCommentRepositoryInterface;
use App\interfaceAdapter\repository\WineRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $bindings = [
            AppellationRepositoryInterface::class => AppellationRepository::class,
            AppellationTypeRepositoryInterface::class => AppellationTypeRepository::class,
            BlindTastingAnswerRepositoryInterface::class => BlindTastingAnswerRepository::class,
            CountryRepositoryInterface::class => CountryRepository::class,
            GrapeVarietyRepositoryInterface::class => GrapeVarietyRepository::class,
            ProducerRepositoryInterface::class => ProducerRepository::class,
            TransactionInterface::class => Transaction::class,
            WineCommentRepositoryInterface::class => WineCommentRepository::class,
            WineRankingRepositoryInterface::class => WineRankingRepository::class,
            WineRepositoryInterface::class => WineRepository::class,
            WineTypesRepositoryInterface::class => WineTypesRepository::class,
            WineVintageRepositoryInterface::class => WineVintageRepository::class,
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
