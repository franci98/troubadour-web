<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="LoginRequest",
 *      description="Request that is used when a user wants to login on the platform.",
 *      type="object",
 *      required={"email","password"}
 * )
 */
class LoginRequest
{
    /**
     * @OA\Property(
     *      title="email",
     *      description="A valid email address.",
     *      example="admin@trubadur.si"
     * )
     */
    public $email;

    /**
     * @OA\Property(
     *      title="password",
     *      description="Password for the account.",
     *      example="test1234"
     * )
     */
    public $password;

}
