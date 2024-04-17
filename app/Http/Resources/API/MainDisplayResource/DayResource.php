<?php

namespace App\Http\Resources\API\MainDisplayResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Mockery\Exception\InvalidArgumentException;

class DayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
             'day'=>$this->day,
             'meal' => MealResource::collection($this->whenLoaded('meal'))->toArray($request),
        ];
    }
}
