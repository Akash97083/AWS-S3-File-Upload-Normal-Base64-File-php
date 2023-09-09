<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//+++++++++++++++++++++++++++++++++++++++
//Route 
//+++++++++++++++++++++++++++++++++++++++
Route::post('upload-normal-file', [App\Http\Controllers\Api\AwsFileUploadController::class, 'normal_file_upload']);
Route::post('upload-base-64-file', [App\Http\Controllers\Api\AwsFileUploadController::class, 'base_64_file_upload']);
