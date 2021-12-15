<?php

namespace App\Http\Controllers\API\v3\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /**
     * @OA\Post (
     *      path="/register",
     *      tags={"Authorization"},
     *      summary="Register a new user",
     *      description="Creates a new user on the platform.",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(ref="#/components/schemas/RegistrationRequest")
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="User successfuly created"
     *       ),
     * )
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ]);

        return response(null, Response::HTTP_CREATED);
    }
}
