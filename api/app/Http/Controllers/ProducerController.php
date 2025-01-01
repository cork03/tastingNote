<?php

namespace App\Http\Controllers;

use App\domain\Producer;
use App\presenter\ProducerPresenter;
use App\usecase\producer\CreateProducerUseCaseInput;
use App\usecase\producer\CreateProducerUseCaseInterface;
use App\usecase\producer\GetProducersUseCaseInterface;
use App\usecase\producer\GetProducerWinesUseCase;
use App\usecase\producer\GetProducerWinesUseCaseInput;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProducerController extends Controller
{
    public function __construct(
        private readonly CreateProducerUseCaseInterface $createProducerUseCase,
        private readonly GetProducersUseCaseInterface $getProducersUseCase,
        private readonly GetProducerWinesUseCase $getProducerWinesUseCase,
        private readonly ProducerPresenter $presenter
    )
    {
    }

    public function create(Request $request): JsonResponse
    {
        $this->createProducerUseCase->handle(
            new CreateProducerUseCaseInput(
                new Producer(
                    id: null,
                    name: $request->name
                )
            )
        );
        return response()->json(status:  201);
    }

    public function getAll(): JsonResponse
    {
        $producers = $this->getProducersUseCase->handle();
        return $this->presenter->getProducersResponse($producers);
    }

    public function getWines(int $id): JsonResponse
    {
        $wines = $this->getProducerWinesUseCase->handle(new GetProducerWinesUseCaseInput($id));
        return $this->presenter->getWinesResponse($wines);
    }
}
