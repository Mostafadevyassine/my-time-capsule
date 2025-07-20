<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Common\AuthController;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');
use App\Http\Controllers\CapsuleController;

Route::get('/capsules', [CapsuleController::class, 'index']);

Route::post('/register', action: [AuthController::class, 'register']);
Route::post( '/login', [AuthController::class, 'login']);

Route::get('/getAllCapsules', action: [CapsuleController::class, 'getAllCapsules']);
Route::get('/getPublicWallCapsules', [CapsuleController::class, 'getPublicWallCapsules']);

Route::get('/getUserWallCapsules', [CapsuleController::class, 'getUserWallCapsules']);

Route::post('/create_capsule', [CapsuleController::class, 'createCapsule']);