<?php

namespace App\Http\Controllers;

use App\domain\Producer;
use App\usecase\producer\CreateProducerUsaCaseInput;
use App\usecase\producer\CreateProducerUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProducerController extends Controller
{
    public function __construct(private readonly CreateProducerUseCaseInterface $createProducerUseCase)
    {
    }

    public function create(Request $request): JsonResponse
    {
        $this->createProducerUseCase->handle(
            new CreateProducerUsaCaseInput(new Producer($request->name))
        );
        return response()->json(status:  201);
    }
}
