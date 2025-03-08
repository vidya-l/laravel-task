<?php
namespace App\Http\Controllers;

use App\Models\Timesheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\Auth;

class TimesheetController extends Controller
{
    /**
     * Create new timesheet
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            $validator = Validator::make($request->all(), [
                'project_id' => 'required|exists:projects,id',
                'hours' => 'required|numeric|min:0',
                'date' => 'required|date',
                'task_name' => 'required|string',
            ]);
            if ($validator->fails()) {
                return ApiResponse::validationError($validator, 400);
            }

            $timesheet = Timesheet::create([
                'user_id' => $user->id,
                'project_id' => $request->project_id,
                'hours' => $request->hours,
                'date' => $request->date,
                'task_name' => $request->task_name,
            ]);

            return ApiResponse::success($timesheet, 'Timesheet created successfully');
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred during creating timesheet: ' . $e->getMessage(), 500);
        }
    }


    /**
     * Update timesheet
     *
     * @param Request $request
     * @param Timesheet $timesheet
     * @return JsonResponse
     */
    public function update(Request $request, Timesheet $timesheet): JsonResponse
    {
        try {
            $user = Auth::user();
            $validator = Validator::make($request->all(), [
                'hours' => 'required|numeric|min:0',
                'date' => 'required|date',
                'task_name' => 'required|string',
            ]);
            if ($validator->fails()) {
                return ApiResponse::validationError($validator, 400);
            }
            if ($timesheet->user_id !== $user->id){
                return ApiResponse::error('Not authorized', 400);
            }
            $timesheet->update([
                'hours' => $request->hours,
                'date' => $request->date,
                'task_name' => $request->task_name,
                
            ]);
            return ApiResponse::success($timesheet, 'Timesheet updated successfully');
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred during project: ' . $e->getMessage(), 500);
        }
    }

    /**
     * List all timesheeets
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $timesheets = Timesheet::where('user_id', auth()->id())->get();
            return ApiResponse::success($timesheets, 'Timesheet listed successfully');
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred during project: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get Timesheet detail
     *
     * @param Request $request
     * @param Timesheet $timesheet
     * @return JsonResponse
     */
    public function getTimesheetDetail(Request $request, Timesheet $timesheet): JsonResponse
    {
        try {
            return ApiResponse::success($timesheet, 'Timesheet detail listed successfully');
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred during project: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Delete Timesheet
     *
     * @param Request $request
     * @param Timesheet $timesheet
     * @return JsonResponse
     */
    public function delete(Request $request, Timesheet $timesheet): JsonResponse
    {
        try {
            $user = Auth::user();
            if ($timesheet->user_id !== $user->id){
                return ApiResponse::error('Not authorized', 400);
            }
            $timesheet->delete();
            return ApiResponse::success($timesheet, 'Timesheet deleted successfully');
        } catch (\Exception $e) {
            return ApiResponse::error('An error occurred during project: ' . $e->getMessage(), 500);
        }
    }
}
