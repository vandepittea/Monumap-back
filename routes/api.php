<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonumentApiController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::middleware('auth:api')->group(function() {
    Route::post('/monuments', [MonumentApiController::class, 'addMonument']);
    Route::put('monuments/{id}', [MonumentApiController::class, 'updateMonument']);
    Route::delete('monuments/{id}', [MonumentApiController::class], 'deleteMonument');
    Route::delete('monuments/{ids}', [MonumentApiController::class], 'deleteMultipleMonuments');
});

Route::get('/monuments', [MonumentApiController::class, 'getAllMonuments']);

Route::get('/monuments/{id}', [MonumentApiController::class, 'getOneMonument']);

Route::post('monuments/register', [AuthController::class, 'register']);

Route::post('monuments/login', [AuthController::class, 'login']);


