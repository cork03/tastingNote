<?php

namespace App\Http\Controllers;

use App\usecase\wineRanking\WineRankingCreateUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WineRankingController
{
    public function __construct(
        private readonly WineRankingCreateUseCaseInterface $wineRankingCreateUseCase
    )
    {
    }

    public function create(Request $request): JsonResponse
    {
        try {
            $this->wineRankingCreateUseCase->handle(
                $request->input('wineVintageId'),
                $request->input('rank')
            );
            return response()->json(status: 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
