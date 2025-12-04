<?php

namespace App\Http\Resources\FoodLogs;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'food_name' => $this->food_name,
            'calories' => $this->calories,
            'protein' => $this->protein,
            'carbs' => $this->carbs,
            'fat' => $this->fat,
            'sugar' => $this->sugar,
            'sodium' => $this->sodium,
            'vit_c' => $this->vit_c,
            'vit_a' => $this->vit_a,
            'potassium' => $this->potassium,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
