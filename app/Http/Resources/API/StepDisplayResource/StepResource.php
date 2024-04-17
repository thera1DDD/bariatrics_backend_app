<?php

namespace App\Http\Resources\API\StepDisplayResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StepResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
             'id'=>$this->id,
             'goal' => $this->goal,
             'current' => $this->current,
             'kkal' => $this->kkal,
             'distance' => $this->distance,
             'achieved_at' => $this->achieved_at,
        ];
    }
}
