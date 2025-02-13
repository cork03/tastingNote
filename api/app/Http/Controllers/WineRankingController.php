<?php

namespace App\Http\Controllers;

use App\domain\WineType;
use App\presenter\WineRankingPresenter;
use App\usecase\wineRanking\GetWineRankingsUseCaseInterface;
use App\usecase\wineRanking\WineRankingCreateUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WineRankingController
{
    public function __construct(
        private readonly WineRankingCreateUseCaseInterface $wineRankingCreateUseCase,
        private readonly GetWineRankingsUseCaseInterface $getWineRankingsUseCase,
        private readonly WineRankingPresenter $presenter
    )
    {
    }

    public function create(Request $request): JsonResponse
    {
        try {
            $this->wineRankingCreateUseCase->handle(
                $request->input('wineVintageId'),
                $request->input('rank'),
                WineType::fromId($request->input('wineTypeId'))
            );
            return response()->json(status: 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function get(Request $request): JsonResponse
    {
        $ranksInfo = $this->getWineRankingsUseCase->handle(WineType::fromId($request->query('wine_type_id')));
        return $this->presenter->getResponse($ranksInfo);
    }
}
