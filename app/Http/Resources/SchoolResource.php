<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      title="School",
 *     description="School details.",
 *     type="object",
 *     @OA\Property(
 *     property="id",
 *     title="id",
 *     description="Unique identifier",
 *     example="1"
 *    ),
 *     @OA\Property(
 *     property="name",
 *     title="name",
 *     description="Name of the school",
 *     example="FRI"
 *     )
 * )
 */
class SchoolResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
