<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\MainDIsplay\EatMealRequest;
use App\Http\Requests\API\MainDIsplay\FilterRequest;
use App\Http\Requests\API\MainDIsplay\GetMealRequest;
use App\Http\Requests\API\MainDIsplay\SendOfferRequest;
use App\Http\Resources\API\MainDisplayResource\DayResource;
use App\Http\Resources\API\MainDisplayResource\MealResource;
use App\Models\Day;
use App\Models\Meal;
use App\Models\Routing;
use App\Services\RoutingService;
use http\Env\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use function Laravel\Prompts\error;
use function PHPUnit\Framework\isFalse;

class StepDisplayController extends Controller
{

    protected RoutingService $routingService;

    public function __construct(RoutingService $routingService)
    {
        $this->routingService = $routingService;
    }

    public function eatMeal(EatMealRequest $request): JsonResponse
    {
       $currentMeal = Meal::find($request->meals_id);
       if(!$currentMeal){
           return response()->json(['message'=>'Такого обеда не существует'],404);
       }
       else{
           $currentMeal->update(['ate_at' => $request->ate_at]);
           $currentMeal->save();
           return response()->json([$currentMeal]);
       }
    }

    public function getSteps(GetMealRequest $request): AnonymousResourceCollection
    {
//        Meal::query()->where('users_id',$request->users_id)->with('item.food')->limit(2)->get();
        $userId = $request->users_id;
        $meals = Day::whereHas('step', function($query) use ($userId) {
        $query->where('users_id', $userId);
      })->with('step')->paginate(5);
      return \App\Http\Resources\API\StepDisplayResource\DayResource::collection($meals);
    }

    public function getRoutes(): JsonResponse {
        $carrierRoutes = (new Routing)->filterByRouteType('carrier')->paginate(4);
        $senderRoutes = (new Routing)->filterByRouteType('sender')->paginate(4);
        return response()->json(['carrier'=>$carrierRoutes,'sender'=>$senderRoutes]);
    }

    public function filterRoutes(FilterRequest $request): JsonResponse {
        $data = $request->validated();
        return $this->routingService->filter($data);
    }
    public function sendOffer(SendOfferRequest $request): JsonResponse {
        $data = $request->validated();
        return $this->routingService->sendOfferToRoute($data);
    }
}
