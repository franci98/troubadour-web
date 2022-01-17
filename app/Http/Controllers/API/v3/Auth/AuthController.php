<?php

namespace App\Http\Controllers\API\v3\Auth;

use App\Http\Controllers\Controller;
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

        $data['password'] = Hash::make($data['password']);
        $user = new User($data);
        $user->save();
        event(new Registered($user));

        return response(null, Response::HTTP_CREATED);
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
     *          @OA\JsonContent(
     *              @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="token",
     *                     type="string"
     *                 ),
     *              )
     *          )
     *       ),
     * )
     */
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);
    }
}
