<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Common\AuthController;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');
use App\Http\Controllers\CapsuleController;

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/getCapsuleById', [CapsuleController::class, 'getCapsuleById']);
        Route::get('/getAllCapsules', [CapsuleController::class, 'getAllCapsules']); // ✅ FIXED
        Route::get('/getPublicWallCapsules', [CapsuleController::class, 'getPublicWallCapsules']);
        Route::post('/getUserWallCapsules', [CapsuleController::class, 'getUserWallCapsules']);
        Route::post('/create_capsule', [CapsuleController::class, 'createCapsule']);
    });
});

Route::get('/capsules', [CapsuleController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']); // ✅ FIXED
Route::post('/login', [AuthController::class, 'login']);



// Route::get('/getCapsuleById', [CapsuleController::class, 'getCapsuleById']);
// Route::get('/getAllCapsules', action: [CapsuleController::class, 'getAllCapsules']);
// Route::get('/getPublicWallCapsules', [CapsuleController::class, 'getPublicWallCapsules']);
// Route::post('/getUserWallCapsules', [CapsuleController::class, 'getUserWallCapsules']);
// Route::post('/create_capsule', [CapsuleController::class, 'createCapsule']);


// Route::get('/capsules', [CapsuleController::class, 'index']);


// Route::post('/register', action: [AuthController::class, 'register']);
// Route::post( '/login', [AuthController::class, 'login']);
