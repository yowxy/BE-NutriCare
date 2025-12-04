<?php

use App\Http\Controllers\Api\Badges\BadgeController;
use App\Http\Controllers\Api\Challenges\ChallengeController;
use App\Http\Controllers\Api\FoodLogs\FoodLogController;
use App\Http\Controllers\Api\Users\UserBadgeController;
use App\Http\Controllers\Api\Users\UserChallengeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user-badges', [UserBadgeController::class, 'index']);

Route::get('/badges', [BadgeController::class, 'index']);
Route::get('/badges/{id}', [BadgeController::class, 'show']);



Route::get('/challenges', [ChallengeController::class, 'index']);
Route::get('/challenges/{id}', [ChallengeController::class, 'show']);
Route::post('/challenges', [ChallengeController::class, 'store']);

Route::get('/user-challenges', [UserChallengeController::class, 'index']);
Route::get('/user-challenges/{id}', [UserChallengeController::class, 'show']);
Route::post('/user-challenges', [UserChallengeController::class, 'store']);
Route::put('/user-challenges/{id}', [UserChallengeController::class, 'update']);



Route::get('/food-logs', [FoodLogController::class, 'index']);
Route::get('/food-logs/{id}', [FoodLogController::class, 'show']);
Route::post('/food-logs', [FoodLogController::class, 'store']);
Route::put('/food-logs/{id}', [FoodLogController::class, 'update']);
Route::delete('/food-logs/{id}', [FoodLogController::class, 'destroy']);
