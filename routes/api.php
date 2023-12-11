<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

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

Route::group(['prefix' => 'v1'], function () {
    Route::get('/movies','\App\Http\Controllers\MovieController@getMovie');

    Route::any('/{path}', function() {
        return response()->json([
            'status'   => 'error',
            'message' => 'Route not found'
        ], Response::HTTP_NOT_FOUND);
    })->where('path', '.*');
});
