<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Function to register user
     *
     * @param Request $request
     * @return ApiResponse
     */
    public function register(Request $request): JsonResponse
    {
        try {
            // Validation rules
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|confirmed',
            ]);
            if ($validator->fails()) {
                return ApiResponse::validationError($validator, 400);
            }
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            
            return ApiResponse::success($user, 'User registered successfully');
            
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred during registration: ' . $e->getMessage(), 500);
        }
    }

    /**
     * function to login
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        try {
            // Validation rules
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return ApiResponse::validationError($validator, 400);
            }
            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return ApiResponse::error('Unauthorized', 401);
            }
            $token = $user->createToken('API Token')->accessToken;
            $user->token =  $token;
            return ApiResponse::success($user, 'Login successful');
            
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred during login: ' . $e->getMessage(), 500);
        }
    }


    /**
     * function for log out
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });

        return ApiResponse::success([], 'Logout successful');
    }
}

