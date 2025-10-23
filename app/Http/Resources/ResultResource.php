<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'wpm' => $this->wpm,
            'accuracy' => $this->accuracy,
            'duration_ms' => $this->duration_ms,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
