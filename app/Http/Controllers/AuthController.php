<?php

namespace App\Http\Controllers;

use App\Services\RegisterUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {

    /**
     * @var RegisterUserService
     */
    protected $registerUserService;

    /**
     * AuthController constructor.
     * @param RegisterUserService $registerUserService
     */
    public function __construct(RegisterUserService $registerUserService) {
        $this->registerUserService = $registerUserService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request) {
        //validate incoming request
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => true, 'message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request) {
        //validate incoming request
        $this->validate($request, [
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);
        try {

            $user = $this->registerUserService->setRequest($request)->handle();
            //return successful response
            return response()->json(['data' => $user, 'message' => 'User Registered'], 201);

        } catch (\Exception $e) {
            Log::error($e);
            //return error message
            return response()->json(['error' => true, 'message' => 'User Registration Failed!'], 409);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => Auth::factory()->getTTL() * 60
        ], 200);
    }
}
