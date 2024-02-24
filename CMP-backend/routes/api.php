<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login',[UserLogController::class,'loginUser']);
Route::post('signup',[UserController::class,'store']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('logout', [UserLogController::class,'userLogout']);
    Route::apiResource('user',UserController::class);
});



// unauthorized user try to use 
Route::get('unauthorized', function () {
    return response()->json(['error' => 'Unauthorized'], 401);
})->name('unauthorized');