<?php

namespace App\Http\Controllers\Api\Badges;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Badge;
use App\Http\Resources\Badges\BadgeResource;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    /**
     * Get all badges
     */
    public function index()
    {
        try {
            $badges = Badge::latest()->get();

            return ResponseFormatter::success(
                BadgeResource::collection($badges),
                'Badges fetched successfully'
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error(
                'Failed to fetch badges: ' . $e->getMessage(),
                500
            );
        }
    }

    /**
     * Get badge by ID
     */
    public function show($id)
    {
        try {
            $badge = Badge::findOrFail($id);

            return ResponseFormatter::success(
                new BadgeResource($badge),
                'Badge fetched successfully'
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ResponseFormatter::error(
                'Badge not found',
                404
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error(
                'Failed to fetch badge: ' . $e->getMessage(),
                500
            );
        }
    }
}
