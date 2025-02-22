<?php

namespace App\Providers;

use App\gateways\FileUploader\FileUploaderInterface;
use App\gateways\FileUploader\S3FIleUploader;
use App\gateways\queryService\GetAppellationTypesQueryService;
use App\gateways\repository\AppellationRepository;
use App\gateways\repository\AppellationTypeRepository;
use App\gateways\repository\blindTasting\BlindTastingRepository;
use App\gateways\repository\blindTasting\BlindTastingRepositoryInterface;
use App\gateways\repository\CountryRepository;
use App\gateways\repository\CountryRepositoryInterface;
use App\gateways\repository\GrapeVarietyRepository;
use App\gateways\repository\GrapeVarietyRepositoryInterface;
use App\gateways\repository\ProducerRepository;
use App\gateways\repository\ProducerRepositoryInterface;
use App\gateways\repository\Transaction;
use App\gateways\repository\wine\wineTypes\WineTypesRepository;
use App\gateways\repository\wine\wineTypes\WineTypesRepositoryInterface;
use App\gateways\repository\wineRanking\WineRankingRepository;
use App\gateways\repository\wineRanking\WineRankingRepositoryInterface;
use App\gateways\repository\WineRepository;
use App\gateways\repository\WineRepositoryInterface;
use App\gateways\repository\wineVintage\WineCommentRepository;
use App\gateways\repository\wineVintage\WineCommentRepositoryInterface;
use App\gateways\repository\WineVintageRepository;
use App\gateways\repository\WineVintageRepositoryInterface;
use App\interfaceAdapter\queryService\GetAppellationTypesQueryServiceInterface;
use App\interfaceAdapter\repository\AppellationRepositoryInterface;
use App\interfaceAdapter\repository\AppellationTypeRepositoryInterface;
use App\interfaceAdapter\repository\TransactionInterface;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(QueryServiceServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(UseCaseServiceProvider::class);
        $bindings = [
            FileUploaderInterface::class => S3FIleUploader::class,
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
        DB::listen(function (QueryExecuted $query) {
            Log::info($query->sql);
            // $query->sql;
            // $query->bindings;
            // $query->time;
            // $query->toRawSql();
        });
    }
}
