<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Get all users
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllUsers(Request $request): JsonResponse
    {
        try {
            $users = User::all();
            return ApiResponse::success($users, 'All users');
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred during registration: ' . $e->getMessage(), 500);
        }
    }


    /**
     * Get a single user detail, if not specified return current user
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function getUserDetail(Request $request, int $id): JsonResponse
    {
        try {
            if(!empty($id)){
                $user = User::find($id);
            }
            if (!$user) {
                return ApiResponse::error('User not found', 401);
            }
            return ApiResponse::success($user, 'User detail');
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred during registration: ' . $e->getMessage(), 500);
        }
    }


    public function updateUser(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user) {
            return ApiResponse::error('User not found', 401);
        }
        if ($request->has('email') && $request->input('email') !== $user->email) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email',
            ]);

            if ($validator->fails()) {
                return ApiResponse::validationError($validator, 400);
            }
        }
        $validator = Validator::make($request->all(), [
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
        ]);
        if ($validator->fails()) {
            return ApiResponse::validationError($validator, 400);
        }

        $user->first_name = $request->input('first_name', $user->first_name);
        $user->last_name = $request->input('last_name', $user->last_name);
        $user->email = $request->input('email', $user->email);

        $user->save();

        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }
}

