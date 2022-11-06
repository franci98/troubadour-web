<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="ForgotPasswordRequest",
 *      description="Request that is used when a user wants to request a password reset link.",
 *      type="object",
 *      required={"email"}
 * )
 */
class ForgotPasswordRequest
{
    /**
     * @OA\Property(
     *      title="email",
     *      description="A valid email address.",
     *      example="john@example.com"
     * )
     */
    public $email;

}
