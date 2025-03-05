<?php

namespace App\Http\Controllers;

use App\presenter\WineCommentPresenter;
use App\usecase\wineComment\CreateWineCommentUseCase\CreateWineCommentUseCaseInput;
use App\usecase\wineComment\CreateWineCommentUseCase\CreateWineCommentUseCaseInterface;
use App\usecase\wineComment\GetWineCommentUseCase\GetWineCommentUseCaseInterface;
use App\usecase\wineComment\LinkWineCommentToWineVintageUseCaseInterface;
use App\usecase\wineComment\UpdateWineCommentUseCase\UpdateWineCommentUseCaseInput;
use App\usecase\wineComment\UpdateWineCommentUseCase\UpdateWineCommentUseCaseInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WineCommentController extends Controller
{
    public function __construct(
        private readonly CreateWineCommentUseCaseInterface            $createWineCommentUseCase,
        private readonly GetWineCommentUseCaseInterface               $getWineCommentUseCase,
        private readonly UpdateWineCommentUseCaseInterface            $updateWineCommentUseCase,
        private readonly LinkWineCommentToWineVintageUseCaseInterface $linkWineCommentToWineVintageUsecase,
        private readonly WineCommentPresenter                         $presenter,
    )
    {

    }

    public function create(Request $request): JsonResponse
    {
        try {
            $wineComment = $request->input('wineComment');
            $this->createWineCommentUseCase->handle(
                new CreateWineCommentUseCaseInput(
                    wineVintageId: $wineComment['wineVintageId'],
                    appearance: $wineComment['appearance'],
                    aroma: $wineComment['aroma'],
                    taste: $wineComment['taste'],
                    anotherComment: $wineComment['anotherComment']
                )
            );
            return response()->json(status: 201);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response()->json(status: 400);
        }
    }

    public function getById(int $id): JsonResponse
    {
        try {
            $wineComment = $this->getWineCommentUseCase->handle($id);
            return $this->presenter->getByIdResponse($wineComment);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response()->json(status: 400);
        }
    }

    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $this->updateWineCommentUseCase->handle(
                new UpdateWineCommentUseCaseInput(
                    id: $id,
                    wineVintageId: $request->input('wineVintageId'),
                    appearance: $request->input('appearance'),
                    aroma: $request->input('aroma'),
                    taste: $request->input('taste'),
                    anotherComment: $request->input('anotherComment')
                )
            );
            return response()->json(status: 201);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response()->json(status: 400);
        }
    }

    public function linkWineVintage(Request $request, int $id): JsonResponse
    {
        try {
            $this->linkWineCommentToWineVintageUsecase->handle($id, $request->input('wineVintageId'));
            return response()->json();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response()->json(status: 400);
        }
    }

}
