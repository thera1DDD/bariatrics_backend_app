<?php

namespace App\Http\Resources\API\MainDisplayResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
             'id'=> $this->id,
             'type'=>$this->type,
             'meal_start_at' => $this->meal_start_at,
             'meal_end_at' => $this->meal_end_at,
             'ate_at' => $this->ate_at,
             'total_kcal' => $this->total_kcal,
             'items' => ItemResource::collection($this->whenLoaded('item'))->toArray($request)
        ];
    }
}
