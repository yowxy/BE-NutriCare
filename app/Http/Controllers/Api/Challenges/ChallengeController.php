<?php

namespace App\Http\Controllers\Api\Challenges;

use App\Helpers\ResponseFromatter;
use App\Http\Controllers\Controller;
use App\Models\Challenge;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index()
    {
        $challenge = Challenge::all()->latest()->get();
        return ResponseFromatter::success($challenge);
    }
}
