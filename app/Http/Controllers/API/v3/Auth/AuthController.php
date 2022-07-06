<?php

namespace App\Http\Controllers\API\v3\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
     *          description="User successfuly created",
     *          @OA\JsonContent(ref="#/components/schemas/TokenResponse")
     *       ),
     * )
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'school_id' => 'required|exists:schools,id',
            'password' => 'required|min:8|confirmed'
        ]);

        $data['password'] = Hash::make($data['password']);
        $user = new User($data);
        $user->save();
        event(new Registered($user));

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);
    }

    /**
     * @OA\Post (
     *      path="/login",
     *      tags={"Authorization"},
     *      summary="Login",
     *      description="Login to the platform.",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(ref="#/components/schemas/LoginRequest")
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Login was successful. An authorization token was issued.",
     *          @OA\JsonContent(ref="#/components/schemas/TokenResponse")
     *       ),
     * )
     */
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Napačen email oz. geslo'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);
    }

    /**
     * @OA\Get  (
     *      path="/users/me",
     *      tags={"Authorization"},
     *      summary="Current user",
     *      description="Gets current user details.",
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(
     *          response=200,
     *          description="User details successfuly retrieved",
     *          @OA\JsonContent(ref="#/components/schemas/UserResource")
     *       ),
     * )
     */
    public function currentUser()
    {
        return UserResource::make(Auth::user());
    }
}
