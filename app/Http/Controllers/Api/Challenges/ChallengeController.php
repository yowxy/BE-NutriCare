<?php

namespace App\Http\Controllers\Api\Challenges;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Http\Resources\Challenges\ChallengeResource;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    /**
     * Get all challenges
     */
    public function index()
    {
        try {
            $challenges = Challenge::latest()->get();

            return ResponseFormatter::success(
                ChallengeResource::collection($challenges),
                'Challenges fetched successfully'
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error(
                'Failed to fetch challenges: ' . $e->getMessage(),
                500
            );
        }
    }

    /**
     * Get challenge by ID
     */
    public function show($id)
    {
        try {
            $challenge = Challenge::findOrFail($id);

            return ResponseFormatter::success(
                new ChallengeResource($challenge),
                'Challenge fetched successfully'
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ResponseFormatter::error(
                'Challenge not found',
                404
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error(
                'Failed to fetch challenge: ' . $e->getMessage(),
                500
            );
        }
    }

    /**
     * Create new challenge
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'points' => 'required|integer|min:0',
                'duration_days' => 'required|integer|min:1',
            ]);

            $challenge = Challenge::create($validated);

            return ResponseFormatter::success(
                new ChallengeResource($challenge),
                'Challenge created successfully',
                201
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ResponseFormatter::error(
                $e->validator->errors()->first(),
                422
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error(
                'Failed to create challenge: ' . $e->getMessage(),
                500
            );
        }
    }
}
