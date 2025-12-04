<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\UserBadge;
use App\Http\Resources\Users\UserBadgeResource;
use App\Helpers\ResponseFormatter;
use Illuminate\Http\Request;

class UserBadgeController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Validasi request (sementara tanpa exists karena PDO driver issue)
            $request->validate([
                'user_id' => 'required|integer'
            ]);

            $userId = $request->query('user_id');

            // Ambil user badges dengan relasi badge
            $userBadges = UserBadge::with('badge')
                ->where('user_id', $userId)
                ->get();

            return ResponseFormatter::success(
                UserBadgeResource::collection($userBadges),
                'User badges fetched successfully'
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ResponseFormatter::error(
                $e->validator->errors()->first(),
                422
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error(
                'Failed to fetch user badges: ' . $e->getMessage(),
                500
            );
        }
    }
}

