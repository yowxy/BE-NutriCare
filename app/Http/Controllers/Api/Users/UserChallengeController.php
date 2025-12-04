<?php

namespace App\Http\Controllers\Api\Users;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\UserChallenge;
use App\Http\Resources\Users\UserChallengeResource;
use Illuminate\Http\Request;

class UserChallengeController extends Controller
{
    /**
     * Get user challenges (with optional user_id filter)
     */
    public function index(Request $request)
    {
        try {
            $query = UserChallenge::with(['user', 'challenge']);

            // Filter by user_id if provided
            if ($request->has('user_id')) {
                $request->validate([
                    'user_id' => 'required|integer'
                ]);
                $query->where('user_id', $request->query('user_id'));
            }

            // Filter by status if provided
            if ($request->has('status')) {
                $query->where('status', $request->query('status'));
            }

            $userChallenges = $query->latest()->get();

            return ResponseFormatter::success(
                UserChallengeResource::collection($userChallenges),
                'User challenges fetched successfully'
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ResponseFormatter::error(
                $e->validator->errors()->first(),
                422
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error(
                'Failed to fetch user challenges: ' . $e->getMessage(),
                500
            );
        }
    }

    /**
     * Get user challenge by ID
     */
    public function show($id)
    {
        try {
            $userChallenge = UserChallenge::with(['user', 'challenge'])->findOrFail($id);

            return ResponseFormatter::success(
                new UserChallengeResource($userChallenge),
                'User challenge fetched successfully'
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ResponseFormatter::error(
                'User challenge not found',
                404
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error(
                'Failed to fetch user challenge: ' . $e->getMessage(),
                500
            );
        }
    }

    /**
     * User joins a challenge
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|integer',
                'challenge_id' => 'required|integer',
                'status' => 'nullable|string|in:active,completed,failed',
                'progress' => 'nullable|integer|min:0|max:100',
            ]);

            // Set default values
            $validated['status'] = $validated['status'] ?? 'active';
            $validated['progress'] = $validated['progress'] ?? 0;
            $validated['started_at'] = now();

            $userChallenge = UserChallenge::create($validated);

            return ResponseFormatter::success(
                new UserChallengeResource($userChallenge->load(['user', 'challenge'])),
                'User challenge created successfully',
                201
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ResponseFormatter::error(
                $e->validator->errors()->first(),
                422
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error(
                'Failed to create user challenge: ' . $e->getMessage(),
                500
            );
        }
    }

    /**
     * Update user challenge progress
     */
    public function update(Request $request, $id)
    {
        try {
            $userChallenge = UserChallenge::findOrFail($id);

            $validated = $request->validate([
                'status' => 'nullable|string|in:active,completed,failed',
                'progress' => 'nullable|integer|min:0|max:100',
            ]);

            // If status is completed, set completed_at
            if (isset($validated['status']) && $validated['status'] === 'completed') {
                $validated['completed_at'] = now();
            }

            $userChallenge->update($validated);

            return ResponseFormatter::success(
                new UserChallengeResource($userChallenge->load(['user', 'challenge'])),
                'User challenge updated successfully'
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ResponseFormatter::error(
                'User challenge not found',
                404
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ResponseFormatter::error(
                $e->validator->errors()->first(),
                422
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error(
                'Failed to update user challenge: ' . $e->getMessage(),
                500
            );
        }
    }
}
