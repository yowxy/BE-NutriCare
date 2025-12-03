<?php

namespace App\Http\Controllers\Api\Users;

use App\Helpers\ResponseFromatter;
use App\Http\Controllers\Controller;
use App\Models\UserChallenge;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseFormatSame;

class UserChallengeController extends Controller
{
    public function index ($userid)
    {
        $userChallange = UserChallenge::with('challange')->get()->where('user_id',$userid);
        return ResponseFromatter::success($userChallange);
    }
}
