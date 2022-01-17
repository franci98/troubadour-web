<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="TokenResponse",
 *      description="This response is issued when the user is successfuly registered/logged in.",
 *      type="object",
 * )
 */
class TokenResponse
{
    /**
     * @OA\Property(
     *      title="token",
     *      description="Authorization token.",
     *      example="3914eb07c4acca7c6fa45c3af5e8c72bbdcc49ddb6802c2f78acc79194307974"
     * )
     */
    public $token;

}
