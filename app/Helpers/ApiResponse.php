<?php
namespace App\Helpers;
use Illuminate\Http\JsonResponse;

class ApiResponse
{
    /**
     * Function to validate 
     *
     * @param mixed $data
     * @param string|null $message
     * @return void
     */
    public static function success($data, string $message = null)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ]);
    }

    /**
     * Undocumented function
     *
     * @param string $message
     * @param integer $statusCode
     * @return void
     */
    public static function error(string $message, int $statusCode = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $statusCode);
    }

    
    /**
     * Return validation error response.
     *
     * @param \Illuminate\Support\MessageBag $errors
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public static function validationError($errors, $statusCode = 400)
    {
        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $errors->messages()
        ], $statusCode);
    }
}