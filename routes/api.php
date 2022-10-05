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

//pendaftaran karyawan
Route::post('/pendaftaran', [App\Http\Controllers\Api\Admin\PendaftaranController::class, 'pendaftaran']);

//group route with prefix "admin"
Route::prefix('admin')->group(function () {

    //route login
    Route::post('/login', [App\Http\Controllers\Api\Admin\LoginController::class, 'index', ['as' => 'admin']]);

    //group route with middleware "auth:api_admin"
     //data user
    Route::get('/user', [App\Http\Controllers\Api\Admin\LoginController::class, 'getUser', ['as' => 'admin']]);

     //refresh token JWT
    Route::get('/refresh', [App\Http\Controllers\Api\Admin\LoginController::class, 'refreshToken', ['as' => 'admin']]);

     //logout
    Route::post('/logout', [App\Http\Controllers\Api\Admin\LoginController::class, 'logout', ['as' => 'admin']]);

     //add karyawam
    Route::post('/add-karyawan', [App\Http\Controllers\Api\Admin\PendaftaranController::class, 'addUser', ['as' => 'admin']]);



    //user inverif
    Route::get('/user-inverif', [App\Http\Controllers\Api\Admin\PendaftaranController::class, 'listInverif', ['as' => 'admin']]);

    Route::post('/edit-karyawan/{id}', [App\Http\Controllers\Api\Admin\PendaftaranController::class, 'editProfile', ['as' => 'admin']]);

    Route::post('/add-loker', [App\Http\Controllers\Api\HRD\LokerController::class, 'tambahLoker', ['as' => 'admin']]);

    Route::post('/edit-loker/{id}', [App\Http\Controllers\Api\HRD\LokerController::class, 'editLoker', ['as' => 'admin']]);

    Route::get('/get-loker', [App\Http\Controllers\Api\HRD\LokerController::class, 'GetLoker', ['as' => 'admin']]);

});



