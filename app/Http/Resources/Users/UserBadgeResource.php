<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserBadgeResource extends JsonResource
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
            'badge_id' => $this->badge_id,
            'earned_at' => $this->earned_at,

            'badge' => [
                'id' => $this->badge?->id,
                'name' => $this->badge?->name,
                'description' => $this->badge?->description,
                'icon' => $this->badge?->icon
            ],
        ];
    }
}
