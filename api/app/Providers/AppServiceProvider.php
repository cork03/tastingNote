<?php

namespace App\Providers;

use App\gateways\FileUploader\FileUploaderInterface;
use App\gateways\FileUploader\S3FIleUploader;
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
