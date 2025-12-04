<?php

namespace App\Http\Controllers\Api\FoodLogs;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\FoodLog;
use App\Http\Resources\FoodLogs\FoodLogResource;
use Illuminate\Http\Request;

class FoodLogController extends Controller
{
    /**
     * Get food logs (with optional user_id filter and date filter)
     */
    public function index(Request $request)
    {
        try {
            $query = FoodLog::with('user');

            // Filter by user_id if provided
            if ($request->has('user_id')) {
                $request->validate([
                    'user_id' => 'required|integer'
                ]);
                $query->where('user_id', $request->query('user_id'));
            }

            // Filter by date range if provided
            if ($request->has('start_date')) {
                $query->whereDate('created_at', '>=', $request->query('start_date'));
            }
            if ($request->has('end_date')) {
                $query->whereDate('created_at', '<=', $request->query('end_date'));
            }

            $foodLogs = $query->latest()->get();

            return ResponseFormatter::success(
                FoodLogResource::collection($foodLogs),
                'Food logs fetched successfully'
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ResponseFormatter::error(
                $e->validator->errors()->first(),
                422
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error(
                'Failed to fetch food logs: ' . $e->getMessage(),
                500
            );
        }
    }

    /**
     * Get food log by ID
     */
    public function show($id)
    {
        try {
            $foodLog = FoodLog::with('user')->findOrFail($id);

            return ResponseFormatter::success(
                new FoodLogResource($foodLog),
                'Food log fetched successfully'
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ResponseFormatter::error(
                'Food log not found',
                404
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error(
                'Failed to fetch food log: ' . $e->getMessage(),
                500
            );
        }
    }

    /**
     * Create new food log
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|integer',
                'food_name' => 'required|string|max:255',
                'calories' => 'required|numeric|min:0',
                'protein' => 'nullable|numeric|min:0',
                'carbs' => 'nullable|numeric|min:0',
                'fat' => 'nullable|numeric|min:0',
                'sugar' => 'nullable|numeric|min:0',
                'sodium' => 'nullable|numeric|min:0',
                'vit_c' => 'nullable|numeric|min:0',
                'vit_a' => 'nullable|numeric|min:0',
                'potassium' => 'nullable|numeric|min:0',
            ]);

            $foodLog = FoodLog::create($validated);

            return ResponseFormatter::success(
                new FoodLogResource($foodLog->load('user')),
                'Food log created successfully',
                201
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ResponseFormatter::error(
                $e->validator->errors()->first(),
                422
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error(
                'Failed to create food log: ' . $e->getMessage(),
                500
            );
        }
    }

    /**
     * Update food log
     */
    public function update(Request $request, $id)
    {
        try {
            $foodLog = FoodLog::findOrFail($id);

            $validated = $request->validate([
                'food_name' => 'nullable|string|max:255',
                'calories' => 'nullable|numeric|min:0',
                'protein' => 'nullable|numeric|min:0',
                'carbs' => 'nullable|numeric|min:0',
                'fat' => 'nullable|numeric|min:0',
                'sugar' => 'nullable|numeric|min:0',
                'sodium' => 'nullable|numeric|min:0',
                'vit_c' => 'nullable|numeric|min:0',
                'vit_a' => 'nullable|numeric|min:0',
                'potassium' => 'nullable|numeric|min:0',
            ]);

            $foodLog->update($validated);

            return ResponseFormatter::success(
                new FoodLogResource($foodLog->load('user')),
                'Food log updated successfully'
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ResponseFormatter::error(
                'Food log not found',
                404
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ResponseFormatter::error(
                $e->validator->errors()->first(),
                422
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error(
                'Failed to update food log: ' . $e->getMessage(),
                500
            );
        }
    }

    /**
     * Delete food log
     */
    public function destroy($id)
    {
        try {
            $foodLog = FoodLog::findOrFail($id);
            $foodLog->delete();

            return ResponseFormatter::success(
                null,
                'Food log deleted successfully'
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ResponseFormatter::error(
                'Food log not found',
                404
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error(
                'Failed to delete food log: ' . $e->getMessage(),
                500
            );
        }
    }
}
