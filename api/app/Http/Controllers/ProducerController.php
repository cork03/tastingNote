<?php

namespace App\Http\Controllers;

use App\domain\Producer;
use App\presenter\ProducerPresenter;
use App\usecase\producer\CreateProducerUsaCaseInput;
use App\usecase\producer\CreateProducerUseCaseInterface;
use App\usecase\producer\GetProducersUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProducerController extends Controller
{
    public function __construct(
        private readonly CreateProducerUseCaseInterface $createProducerUseCase,
        private readonly GetProducersUseCaseInterface $getProducersUseCase,
        private readonly ProducerPresenter $presenter
    )
    {
    }

    public function create(Request $request): JsonResponse
    {
        $this->createProducerUseCase->handle(
            new CreateProducerUsaCaseInput(
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
}
