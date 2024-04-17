<?php

namespace App\Http\Resources\API\StepDisplayResource;

use App\Http\Resources\API\StepDisplayResource\StepResource;
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
             'step' => StepResource::collection($this->whenLoaded('step'))->toArray($request),
        ];
    }
}
