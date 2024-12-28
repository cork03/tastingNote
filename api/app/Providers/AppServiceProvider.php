<?php

namespace App\Providers;

use App\gateways\repository\ProducerRepository;
use App\gateways\repository\ProducerRepositoryInterface;
use App\usecase\producer\CreateProducerUsaCase;
use App\usecase\producer\CreateProducerUseCaseInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CreateProducerUseCaseInterface::class, CreateProducerUsaCase::class);
        $this->app->bind(ProducerRepositoryInterface::class, ProducerRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
