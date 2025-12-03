<?php

namespace App\Http\Controllers\Api\Users;

use App\Helpers\ResponseFromatter;
use App\Http\Controllers\Controller;
use App\Models\UserBadge;
use Illuminate\Http\Request;

class UserBadgeController extends Controller
{
    public function index ($userid)
    {
        $userbadge = UserBadge::with('badge')->where('user_id',$userid)->get();
        return ResponseFromatter::success($userbadge);
    }
}
