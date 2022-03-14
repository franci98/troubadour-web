<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      title="User",
 *      description="User details.",
 *      type="object",
 * )
 */
class UserResource extends JsonResource
{
    /**
     * @OA\Property(
     *      title="id",
     *      description="Unique identifier",
     *      example="1"
     * )
     */
    private $id;

    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the user",
     *      example="John"
     * )
     */
    private $name;

    /**
     * @OA\Property(
     *      title="email",
     *      description="Email of the user",
     *      example="john@example.com"
     * )
     */
    private $email;

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
