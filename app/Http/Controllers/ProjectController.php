<?php
// app/Http/Controllers/ProjectController.php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use App\Helpers\ApiResponse;
use App\Models\Attribute;
use Carbon\Carbon;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Project::query();
            if ($request->has('filters')) {
                $filters = $request->filters;
                foreach ($filters as $key => $filterValue) {
                    if (in_array($key, ['name', 'status'])) { // if name or status search in project table itself
                        $query->where($key, 'like', "%$filterValue%");
                    }else{ // search in attributes
                        $attribute = Attribute::where('name', $key)->first();
                        if ($attribute) {
                            $operator = 'like';  // Default operator
                            // Check if an operator is included in the filter value (e.g., department>=IT)
                            
                            if (strpos($filterValue, '>') !== false) {
                                $operator = '>';
                                $filterValue = str_replace('>', '', $filterValue);
                            } elseif (strpos($filterValue, '<') !== false) {
                                $operator = '<';
                                $filterValue = str_replace('<', '', $filterValue);
                            }
                             //if attribute type is date parse to date
                             if($attribute->type === 'date'){
                                $filterValue =  Carbon::createFromFormat('Y-m-d', $filterValue)->toDateString();
                            }
                            // Apply filtering based on operator and value
                            $query->whereHas('dynamicAttributes', function ($q) use ($attribute, $filterValue, $operator) {
                                if ($operator === 'like') {
                                    $q->where('attribute_values.attribute_id', $attribute->id)
                                      ->where('attribute_values.value', 'like', "%$filterValue%");
                                } else {
                                    $q->where('attribute_values.attribute_id', $attribute->id)
                                    ->where('attribute_values.value', $operator, $filterValue);
                                }
                            });
                        }
                    }
                }
            }

            $projects = $query->with('dynamicAttributes')->get();
            return ApiResponse::success($projects, 'Projects listed successfully');
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred during project: ' . $e->getMessage(), 500);
        }
    }

    /**
     * create project function
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'project_attributes' => 'nullable|array',
                'project_attributes.*.attribute_id' => 'required|integer|exists:attributes,id',
                'project_attributes.*.value' => 'required|string',
            ]);
            if ($validator->fails()) {
                return ApiResponse::validationError($validator, 400);
            }
            $request->merge(['status' => 'pending']); //default status
            $project = Project::create($request->only(['name', 'status']));
            if ($request->has('project_attributes')) {
                foreach ($request->project_attributes as $attribute) {
                        $oattribute = Attribute::where('id', $attribute['attribute_id'])->first();
                        if ($oattribute && $oattribute->type === 'date') {
                            $date = Carbon::createFromFormat('d-m-Y', $attribute['value']);
                            if (!$date || $date->format('d-m-Y') !== $attribute['value']) {
                                return ApiResponse::error('Invalid date format. Please use DD-MM-YYYY format.', 400);
                            }

                            $formattedDate = $date->format('Y-m-d');
                            $attribute['value'] = $formattedDate;
                        }
                        AttributeValue::create([
                            'attribute_id' => $oattribute->id,
                            'entity_id' => $project->id,
                            'value' => $attribute['value'],
                        ]);
                }
            }
            return ApiResponse::success($project, 'Project created successfully');
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred during project: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Project detail with attributes
     *
     * @param Project $project
     * @return JsonResponse
     */
    public function getProjectDetail(Project $project): JsonResponse
    {
        try {
            $project->load('dynamicAttributes.attribute');
            return ApiResponse::success($project, 'Project details');
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred during project: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Update project
     *
     * @param Request $request
     * @param Project $project
     * @return JsonResponse
     */
    public function update(Request $request, Project $project): JsonResponse
    {
        try{
            $request->validate([
                'name' => 'required|string',
                'status' => 'in:pending,in_progress,completed',
                'project_attributes' => 'nullable|array',
                'project_attributes.*.attribute_id' => 'required|integer|exists:attributes,id',
                'project_attributes.*.value' => 'required|string',
            ]);

            $project->update($request->only(['name', 'status', 'project_attributes']));
            if ($request->has('project_attributes')) {
                // Delete attributes that are not passed in the request
                $existingAttributeIds = collect($request->project_attributes)->pluck('attribute_id');
                $project->dynamicAttributes()->whereNotIn('attribute_id', $existingAttributeIds)->delete();
                foreach ($request->project_attributes as $attributeId => $attribute) {
                    $oattribute = Attribute::where('id', $attribute['attribute_id'])->first();
                    if ($oattribute && $oattribute->type === 'date') {
                        $date = Carbon::createFromFormat('d-m-Y', $attribute['value']);
                        if (!$date || $date->format('d-m-Y') !== $attribute['value']) {
                            return ApiResponse::error('Invalid date format. Please use DD-MM-YYYY format.', 400);
                        }

                        $formattedDate = $date->format('Y-m-d');
                        $attribute['value'] = $formattedDate;
                    }
                    AttributeValue::updateOrCreate(
                        ['attribute_id' => $attribute['attribute_id'], 'entity_id' => $project->id],
                        ['value' => $attribute['value']]
                    );
                }
            }
            return ApiResponse::success($project, 'Project updated successfully');
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred during updating project: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Delete project
     *
     * @param Request $request
     * @param Project $project
     * @return JsonResponse
     */
    public function delete(Request $request, Project $project): JsonResponse
    {
        try {
            $project->delete();
            return ApiResponse::success('project deleted successfully');
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred during project: ' . $e->getMessage(), 500);
        }
    }
}
