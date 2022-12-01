<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DashboardController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('inputdata', [DashboardController::class,'SaveInputValue']);

Route::post('outputdata', [DashboardController::class,'SaveOutputValue']);

Route::name('getData.')
    ->prefix('getData')
    ->group(function(){    
        Route::get('query',[DashboardController::class,'query'])
        ->name('query');
        Route::get('GetOutputData',[DashboardController::class,'GetOutputData'])
        ->name('GetOutputData');
    });
