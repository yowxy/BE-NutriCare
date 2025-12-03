<?php

namespace App\Http\Controllers\Api\FoodLogs;

use App\Helpers\ResponseFromatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\FoodLogs\StoreFoodLogRequest;
use App\Models\FoodLog;
use Illuminate\Http\Request;

class FoodLogController extends Controller
{
    public function index($userid)
    {
        $foodlogs = FoodLog::where('user_id', $userid)->latest()->get();
        // return ResponseFromatter::success($foodlogs);
    }

    public function store(StoreFoodLogRequest $request)
    {
        $foodlogStore = FoodLog::create($request->validated());
        return ResponseFromatter::success($foodlogStore);
    }

    public function delete(FoodLog $foodlog)
    {
        $foodlog->delete();
        return ResponseFromatter::success($foodlog);
    }
}
