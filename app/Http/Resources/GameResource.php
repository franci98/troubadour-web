<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      title="Game",
 *      description="Game details.",
 *      type="object",
 * )
 */
class GameResource extends JsonResource
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
