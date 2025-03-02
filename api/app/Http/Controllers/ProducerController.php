<?php

namespace App\Http\Controllers;

use App\domain\Country;
use App\domain\Producer;
use App\presenter\ProducerPresenter;
use App\usecase\producer\CreateProducerUseCaseInput;
use App\usecase\producer\CreateProducerUseCaseInterface;
use App\usecase\producer\GetProducersUseCaseInterface;
use App\usecase\producer\GetProducerUseCaseInterface;
use App\usecase\producer\GetProducerWinesUseCase\GetProducerWinesUseCase;
use App\usecase\producer\GetProducerWinesUseCase\GetProducerWinesUseCaseInput;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProducerController extends Controller
{
    public function __construct(
        private readonly CreateProducerUseCaseInterface $createProducerUseCase,
        private readonly GetProducersUseCaseInterface $getProducersUseCase,
        private readonly GetProducerUseCaseInterface $getProducerUseCase,
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
                    name: $request->name,
                    country: new Country($request->countryId, null),
                    description: $request->description,
                    url: $request->url
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

    public function getOne(int $id): JsonResponse
    {
        $producer = $this->getProducerUseCase->handle($id);
        if (!isset($producer)) {
            return response()->json(status: 404);
        } else {
            return $this->presenter->getProducerResponse($producer);
        }

    }

    public function getWines(int $id): JsonResponse
    {
        $wines = $this->getProducerWinesUseCase->handle(new GetProducerWinesUseCaseInput($id));
        return $this->presenter->getWinesResponse($wines);
    }
}
