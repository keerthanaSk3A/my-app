<?php

namespace App\Http\Controllers;

use App\Events\HandsetViewedEvent;
use App\Http\Requests\HandSetFilterRequest;
use App\Http\Resources\HandSetResource;
use App\Services\HandSetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HandSetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(
        HandSetFilterRequest $request,
        HandSetService $handSetService
    ): JsonResponse | AnonymousResourceCollection
    {
        $handsets = $handSetService->getFilterHandsets($request->validated());

        //trigger fetch event
        event(new HandsetViewedEvent($handsets));

        return HandSetResource::collection($handsets);
    }
}
