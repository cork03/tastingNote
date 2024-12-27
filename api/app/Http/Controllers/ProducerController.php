<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProducerController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        return response()->json([
            'name' => $request->name
        ]);
    }
}
