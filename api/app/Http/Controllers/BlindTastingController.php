<?php

namespace App\Http\Controllers;

use App\domain\BlindTastingAnswer;
use App\domain\GrapeVariety;
use App\domain\WineBlend;
use App\domain\WineComment;
use App\domain\WineVariety;
use App\usecase\blindTasting\BlindTastingCreateUsecaseInput;
use App\usecase\blindTasting\BlindTastingCreateUsecaseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlindTastingController extends Controller
{
    public function __construct(
        private readonly BlindTastingCreateUsecaseInterface $blindTastingCreateUsecase
    )
    {
    }

    public function create(Request $request): JsonResponse
    {
        try {
            $wineCommentInput = $request->input('wineComment');
            $blindTastingAnswerInput = $request->input('blindTastingAnswer');

            $wineComment = new WineComment(
                id: null,
                wine_vintage_id: null,
                appearance: $wineCommentInput['appearance'],
                aroma: $wineCommentInput['aroma'],
                taste: $wineCommentInput['taste'],
                another_comment: $wineCommentInput['anotherComment'],
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

            $blindTastingAnswer = new BlindTastingAnswer(
                id: null,
                wineCommentId: null,
                countryId: $blindTastingAnswerInput['countryId'],
                vintage: $blindTastingAnswerInput['vintage'],
                price: $blindTastingAnswerInput['price'],
                alcoholContent: $blindTastingAnswerInput['alcoholContent'],
                wineBlend: new WineBlend(wineVarieties: $wineVarieties),
                anotherComment: $blindTastingAnswerInput['anotherComment'],
            );

            $this->blindTastingCreateUsecase->handle(new BlindTastingCreateUsecaseInput(
                wineComment: $wineComment,
                blindTastingAnswer: $blindTastingAnswer,
            ));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return response()->json(status: 400);
        }

        return response()->json(status: 201);
    }
}
