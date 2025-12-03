<?php

namespace App\Http\Controllers\Api\Badges;

use App\Helpers\ResponseFromatter;
use App\Http\Controllers\Controller;
use App\Models\Badge;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseFormatSame;

class BadgeController extends Controller
{
    public function index ()
    {
        $badge = Badge::all()->latest()->get();
        return ResponseFromatter::success($badge);
    }
}
