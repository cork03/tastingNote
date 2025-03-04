<?php

namespace App\Http\Controllers;

use App\domain\GrapeVariety;
use App\domain\WineBlend;
use App\domain\WineVariety;
use App\usecase\blindTasting\BlindTastingCreateUseCase\BlindTastingAnswerInputDTO;
use App\usecase\blindTasting\BlindTastingCreateUseCase\BlindTastingCreateUseCaseInput;
use App\usecase\blindTasting\BlindTastingCreateUseCase\BlindTastingCreateUseCaseInterface;
use App\usecase\blindTasting\BlindTastingCreateUseCase\WineCommentInputDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlindTastingController extends Controller
{
    public function __construct(
        private readonly BlindTastingCreateUseCaseInterface $blindTastingCreateUsecase
    )
    {
    }

    public function create(Request $request): JsonResponse
    {
        try {
            $wineCommentInput = $request->input('wineComment');
            $blindTastingAnswerInput = $request->input('blindTastingAnswer');

            $wineComment = new WineCommentInputDTO(
                wineVintageId: null,
                appearance: $wineCommentInput['appearance'],
                aroma: $wineCommentInput['aroma'],
                taste: $wineCommentInput['taste'],
                anotherComment: $wineCommentInput['anotherComment'],
            );

            $wineVarieties = [];
            $wineBlendInput = $blindTastingAnswerInput['wineBlend'];
            foreach ($wineBlendInput as $wineVariety) {
                $wineVarieties[] = new WineVariety(
                    grapeVariety: new GrapeVariety(
                        id: $wineVariety['grapeVarietyId'],
                        name: null,
                    ),
                    percentage: $wineVariety['percentage'],
                );
            }

            $blindTastingAnswer = new BlindTastingAnswerInputDTO(
                countryId: $blindTastingAnswerInput['countryId'],
                vintage: $blindTastingAnswerInput['vintage'],
                price: $blindTastingAnswerInput['price'],
                alcoholContent: $blindTastingAnswerInput['alcoholContent'],
                wineBlend: new WineBlend(wineVarieties: $wineVarieties),
                anotherComment: $blindTastingAnswerInput['anotherComment'],
            );

            $commentId = $this->blindTastingCreateUsecase->handle(new BlindTastingCreateUseCaseInput(
                wineComment: $wineComment,
                blindTastingAnswer: $blindTastingAnswer,
            ));
            return response()->json(
                data: ['id' => $commentId],
                status: 201
            );
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return response()->json(status: 400);
        }

    }
}
