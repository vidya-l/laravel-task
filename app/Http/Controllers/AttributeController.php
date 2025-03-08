<?php
// app/Http/Controllers/AttributeController.php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use App\Helpers\ApiResponse;

class AttributeController extends Controller
{
    /**
     * Create new attribute
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|unique:attributes,name',
                'type' => 'required|string|in:text,date,number,select',
            ]);
            if ($validator->fails()) {
                return ApiResponse::validationError($validator, 400);
            }

            $attribute = Attribute::create([
                'name' => $request->name,
                'type' => $request->type,
            ]);

            return ApiResponse::success($attribute, 'Attribute created successfully');
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred during attribute: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Update attribute
     *
     * @param Request $request
     * @param Attribute $attribute
     * @return JsonResponse
     */
    public function update(Request $request, Attribute $attribute): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|unique:attributes,name,' . $attribute->id,
                'type' => 'required|string|in:text,date,number,select',
            ]);
            if ($validator->fails()) {
                return ApiResponse::validationError($validator, 400);
            }
            $attribute->update([
                'name' => $request->name,
                'type' => $request->type,
            ]);
            return ApiResponse::success($attribute, 'Project updated successfully');
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred during project: ' . $e->getMessage(), 500);
        }
    }

    /**
     * List all attributes
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $attribute = Attribute::all();
            return ApiResponse::success($attribute, 'Attributes listed successfully');
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred during project: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get attribute detail
     *
     * @param Request $request
     * @param Attribute $attribute
     * @return JsonResponse
     */
    public function getAttributeDetail(Request $request, Attribute $attribute): JsonResponse
    {
        try {
            return ApiResponse::success($attribute, 'Attribute detail listed successfully');
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred during project: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Delete Attribute
     *
     * @param Request $request
     * @param Attribute $attribute
     * @return JsonResponse
     */
    public function delete(Request $request, Attribute $attribute): JsonResponse
    {
        try {
            $attribute->delete();
            return ApiResponse::success($attribute, 'Attribute deleted successfully');
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred during project: ' . $e->getMessage(), 500);
        }
    }
}
