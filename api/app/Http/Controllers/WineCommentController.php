<?php

namespace App\Http\Controllers;

use App\domain\WineComment;
use App\usecase\wineComment\LinkWineCommentToWineVintageUseCaseInterface;
use App\usecase\wineVintage\CreateWineCommentUseCaseInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WineCommentController extends Controller
{
    public function __construct(
        private readonly CreateWineCommentUseCaseInterface            $createWineCommentUseCase,
        private readonly LinkWineCommentToWineVintageUseCaseInterface $linkWineCommentToWineVintageUsecase,
    )
    {

    }

    public function create(Request $request): JsonResponse
    {
        try {
            $wineComment = $request->input('wineComment');
            $this->createWineCommentUseCase->handle(new WineComment(
                    id: null,
                    wineVintageId: $wineComment['wineVintageId'],
                    appearance: $wineComment['appearance'],
                    aroma: $wineComment['aroma'],
                    taste: $wineComment['taste'],
                    anotherComment: $wineComment['anotherComment'])
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
