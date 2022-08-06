<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="RegistrationRequest",
 *      description="Request that is used when a guest wants to register on the platform.",
 *      type="object",
 *      required={"name","email","password","password_confirmation","school_id"}
 * )
 */
class RegistrationRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the user. This will be visible to other users.",
     *      example="Johnny"
     * )
     */
    public $name;

    /**
     * @OA\Property(
     *      title="email",
     *      description="A valid email address.",
     *      example="john@example.com"
     * )
     */
    public $email;

    /**
     * @OA\Property(
     *      title="password",
     *      description="Password for the account. Should be atleast 8 characters long.",
     *      example="test1234"
     * )
     */
    public $password;

    /**
     * @OA\Property(
     *      title="Password confirmation",
     *      description="Same as password field.",
     *      example="test1234"
     * )
     */
    public $password_confirmation;

    /**
     * @OA\Property(
     *      title="School id",
     *      description="Id of the user school.",
     *      example="1"
     * )
     */
    public $school_id;

}
