<?php

namespace App\Http\Resources\API\MainDisplayResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
             'quantity' => $this->quantity,
             'name' => $this->food->name,
             'gram' => $this->food->gram,
             'kkal' => $this->food->kkal,

        ];
    }
}
