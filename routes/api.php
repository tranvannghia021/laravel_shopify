<?php

use App\Http\Controllers\api\ApiWebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('/webhook')->group(function(){
    Route::any('/create',[ApiWebhookController::class,'listenWebHookCreate']);
    // Route::any('/create',function(Request $request){
    //     dd($request->collect());
    // });
    Route::any('/update',[ApiWebhookController::class,'listenWebHookUpdate']);
    Route::any('/delete',[ApiWebhookController::class,'listenWebHookDelete']);

});
