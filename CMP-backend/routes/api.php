<?php

use App\Http\Controllers\AssignRoleToUserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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
Route::controller(UserController::class)->group(function(){
    Route::post('login','loginUser');
});
Route::post('user/signup', [UserController::class, 'store']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('authuser', [UserController::class, 'getUserDetail']);
    Route::get('logout', [UserController::class, 'userLogout']);
    Route::post('user/vel', [UserController::class, 'vel']);
    Route::apiResource('user', UserController::class);
    Route::get('role/create', [RoleController::class, 'create']);
    Route::apiResource('role', RoleController::class);
    Route::get('assign-role/create', [AssignRoleToUserController::class, 'create']);
    Route::apiResource('assign-role', AssignRoleToUserController::class);
});

// unauthorized user try to use 
Route::get('unauthorized', function () {
    return response()->json(['error' => 'Unauthorized.'], 401);
})->name('unauthorized');






    

