<?php

namespace App\Http\Controllers;

use App\domain\GrapeVariety;
use App\domain\WineBlend;
use App\domain\WineVariety;
use App\domain\WineVintage;
use App\presenter\WineVintagePresenter;
use App\usecase\wineVintage\CreateUseCaseInterface;
use App\usecase\wineVintage\CreateWineVintageAndLinkCommentUseCaseInput;
use App\usecase\wineVintage\CreateWineVintageAndLinkCommentUseCaseInterface;
use App\usecase\wineVintage\CreateWineVintageUseCaseInput;
use App\usecase\wineVintage\EditWineVintageUseCaseInterface;
use App\usecase\wineVintage\GetFullInfoUseCaseInterface;
use App\usecase\wineVintage\GetNotRegisteredRankingWineVintagesUseCaseInterface;
use App\usecase\wineVintage\GetWineCommentsUseCaseInterface;
use App\usecase\wineVintage\GetWineVintageByIdUseCaseInterface;
use App\usecase\wineVintage\GetWineVintagesByIdUseCaseInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WineVintageController extends Controller
{
    public function __construct(
        private readonly CreateUseCaseInterface                              $createWineVintageUseCase,
        private readonly CreateWineVintageAndLinkCommentUseCaseInterface     $createWineVintageAndLinkCommentUseCase,
        private readonly EditWineVintageUseCaseInterface                     $editWineVintageUseCase,
        private readonly GetFullInfoUseCaseInterface                         $getFullInfoUseCase,
        private readonly GetWineCommentsUseCaseInterface                     $getWineCommentsUseCase,
        private readonly GetWineVintageByIdUseCaseInterface                  $getWineVintageByIdUseCase,
        private readonly GetWineVintagesByIdUseCaseInterface                 $getWineVintagesByIdUseCase,
        private readonly GetNotRegisteredRankingWineVintagesUseCaseInterface $getNotRegisterdRankingWineVintagesUseCase,
        private readonly WineVintagePresenter                                $wineVintagePresenter
    )
    {
    }

    public function create(Request $request): JsonResponse
    {
        try {
            $wineVintage = $request->input('wineVintage');
            $wineVarieties = [];
            foreach ($wineVintage['wineBlend'] as $wineVariety) {
                $wineVarieties[] = new WineVariety(
                    grapeVariety: new GrapeVariety(
                        id: $wineVariety['grapeVarietyId'],
                        name: null
                    ),
                    percentage: $wineVariety['percentage'],
                );
            }
            $this->createWineVintageUseCase->handle(
                new CreateWineVintageUseCaseInput(
                    new WineVintage(
                        id: null,
                        wineId: $wineVintage['wineId'],
                        vintage: $wineVintage['vintage'],
                        price: $wineVintage['price'],
                        agingMethod: $wineVintage['agingMethod'],
                        alcoholContent: $wineVintage['alcoholContent'],
                        wineBlend: new WineBlend($wineVarieties),
                        technicalComment: $wineVintage['technicalComment'],
                    ),
                    $wineVintage['base64Image']
                )
            );
            return response()->json(status: 201);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response()->json(data: $e->getMessage(), status: 400);
        }
    }

    public function createAndLinkComment(Request $request, int $id): JsonResponse
    {
        try {
            $wineVintage = $request->input('wineVintage');
            $wineVarieties = [];
            foreach ($wineVintage['wineBlend'] as $wineVariety) {
                $wineVarieties[] = new WineVariety(
                    grapeVariety: new GrapeVariety(
                        id: $wineVariety['grapeVarietyId'],
                        name: null
                    ),
                    percentage: $wineVariety['percentage'],
                );
            }
            $this->createWineVintageAndLinkCommentUseCase->handle(
                new CreateWineVintageAndLinkCommentUseCaseInput(
                    wineVintage: new WineVintage(
                        id: null,
                        wineId: $wineVintage['wineId'],
                        vintage: $wineVintage['vintage'],
                        price: $wineVintage['price'],
                        agingMethod: $wineVintage['agingMethod'],
                        alcoholContent: $wineVintage['alcoholContent'],
                        wineBlend: new WineBlend($wineVarieties),
                        technicalComment: $wineVintage['technicalComment'],
                    ),
                    base64Image: $wineVintage['base64Image'],
                    commentId: $id
                )
            );
            return response()->json(status: 201);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response()->json(data: $e->getMessage(), status: 400);
        }
    }

    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $wineVintage = $request->input('wineVintage');
            $wineVarieties = [];
            foreach ($wineVintage['wineBlend'] as $wineVariety) {
                $wineVarieties[] = new WineVariety(
                    grapeVariety: new GrapeVariety(
                        id: $wineVariety['grapeVarietyId'],
                        name: null
                    ),
                    percentage: $wineVariety['percentage'],
                );
            }
            $this->editWineVintageUseCase->handle(
                wineVintage: new WineVintage(
                    id: $id,
                    wineId: $wineVintage['wineId'],
                    vintage: $wineVintage['vintage'],
                    price: $wineVintage['price'],
                    agingMethod: $wineVintage['agingMethod'],
                    alcoholContent: $wineVintage['alcoholContent'],
                    wineBlend: new WineBlend($wineVarieties),
                    technicalComment: $wineVintage['technicalComment'],
                ),
                base64Image: $wineVintage['base64Image']
            );
            return response()->json();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response()->json(data: $e->getMessage(), status: 400);
        }
    }

    public function getOne(int $wineId, int $vintage): JsonResponse
    {
        try {
            $wineVintageFullInfo = $this->getFullInfoUseCase->handle($wineId, $vintage);
            return $this->wineVintagePresenter->getFullInfoResponse($wineVintageFullInfo);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response()->json(status: 404);
        }
    }

    public function getById(int $id): JsonResponse
    {
        $wineVintageInfo = $this->getWineVintageByIdUseCase->handle($id);
        if (!isset($wineVintageInfo)) {
            return response()->json(status: 404);
        }
        return $this->wineVintagePresenter->getWineVintageByIdResponse($wineVintageInfo);
    }

    public function getNotRegisteredRanking(): JsonResponse
    {
        $notRegisteredWineVintageInfo = $this->getNotRegisterdRankingWineVintagesUseCase->handle();
        return $this->wineVintagePresenter->getNotRegisteredRankingWineVintagesResponse($notRegisteredWineVintageInfo);
    }

    public function getAllByWineId(int $id): JsonResponse
    {
        $wineVintages = $this->getWineVintagesByIdUseCase->handle($id);
        return $this->wineVintagePresenter->getWineVintagesByIdResponse($wineVintages);
    }

    public function getWineComments(int $id): JsonResponse
    {
        $comments = $this->getWineCommentsUseCase->handle($id);
        return $this->wineVintagePresenter->getWineCommentsResponse($comments);
    }
}
