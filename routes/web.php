<?php

use App\Http\Controllers\BastController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {

    Route::get("/", ['as' => 'index', 'uses' => 'App\Http\Controllers\HomeController@index']);

    Route::group(["prefix" => "profile", "as" => "profile."], function () {
        Route::get('/', ['uses' => 'App\Http\Controllers\ProfileController@edit', 'as' => 'edit']);
        Route::patch('/', ['uses' => 'App\Http\Controllers\ProfileController@update', 'as' => 'update']);
        Route::delete('/', ['uses' => 'App\Http\Controllers\ProfileController@destroy', 'as' => 'destroy']);
    });

    Route::group(["prefix" => "roles", "as" => "roles."], function () {
        Route::get("/", ['uses' => 'App\Http\Controllers\RoleController@index', 'as' => 'index']);
        Route::get("/list", ['uses' => 'App\Http\Controllers\RoleController@list', 'as' => 'list']);
        Route::get("/datatable", ['uses' => 'App\Http\Controllers\RoleController@datatable', 'as' => 'datatable']);
        Route::get("/create", ['uses' => 'App\Http\Controllers\RoleController@create', 'as' => 'create']);
        Route::post("/store", ['uses' => 'App\Http\Controllers\RoleController@store', 'as' => 'store']);
        Route::get("/edit/{id}", ['uses' => 'App\Http\Controllers\RoleController@edit', 'as' => 'edit']);
        Route::put("/update/{id}", ['uses' => 'App\Http\Controllers\RoleController@update', 'as' => 'update']);
        Route::delete("/delete/{id}", ['uses' => 'App\Http\Controllers\RoleController@destroy', 'as' => 'delete']);
    });

    Route::group(["prefix" => "user", "as" => "user."], function () {
        Route::get("/", ['uses' => 'App\Http\Controllers\UserController@index', 'as' => 'index']);
        Route::get("/datatable", ['uses' => 'App\Http\Controllers\UserController@datatable', 'as' => 'datatable']);
        Route::get("/create", ['uses' => 'App\Http\Controllers\UserController@create', 'as' => 'create']);
        Route::post("/store", ['uses' => 'App\Http\Controllers\UserController@store', 'as' => 'store']);
        Route::get("/edit/{id}", ['uses' => 'App\Http\Controllers\UserController@edit', 'as' => 'edit']);
        Route::put("/update/{id}", ['uses' => 'App\Http\Controllers\UserController@update', 'as' => 'update']);
        Route::delete("/delete/{id}", ['uses' => 'App\Http\Controllers\UserController@destroy', 'as' => 'delete']);
    });

    Route::group(["prefix" => "project", "as" => "project."], function () {
        Route::get("/", ['uses' => 'App\Http\Controllers\ProjectController@index', 'as' => 'index']);
        Route::get("/datatable", ['uses' => 'App\Http\Controllers\ProjectController@datatable', 'as' => 'datatable']);
        Route::get("/create", ['uses' => 'App\Http\Controllers\ProjectController@create', 'as' => 'create']);
        Route::post("/store", ['uses' => 'App\Http\Controllers\ProjectController@store', 'as' => 'store']);
        Route::get("/edit/{id}", ['uses' => 'App\Http\Controllers\ProjectController@edit', 'as' => 'edit']);
        Route::put("/update/{id}", ['uses' => 'App\Http\Controllers\ProjectController@update', 'as' => 'update']);
        Route::delete("/delete/{id}", ['uses' => 'App\Http\Controllers\ProjectController@destroy', 'as' => 'delete']);
    });

    Route::group(["prefix" => "bast", "as" => "bast."], function () {
        Route::get('/view/{id}', ['uses' => 'App\Http\Controllers\BastController@view', 'as' => 'view']);
        Route::get("/datatable", ['uses' => 'App\Http\Controllers\BastController@datatable', 'as' => 'datatable']);
        Route::get("/create/{id}", ['uses' => 'App\Http\Controllers\BastController@create', 'as' => 'create']);
        Route::post('/store', ['uses' => 'App\Http\Controllers\BastController@store', 'as' => 'store']);
        Route::get('/edit/{id}/{projectid}', ['uses' => 'App\Http\Controllers\BastController@edit', 'as' => 'edit']);
        Route::put('/update', ['uses' => 'App\Http\Controllers\BastController@update', 'as' => 'update']);
        Route::get('/delete/{id}', ['uses' => 'App\Http\Controllers\BastController@delete', 'as' => 'delete']);
        Route::get('/detail/{id}', ['uses' => 'App\Http\Controllers\BastController@detail', 'as' => 'detail']);
        Route::get('/detail-create', ['uses' => 'App\Http\Controllers\BastController@create_detail', 'as' => 'create-detail']);
        Route::get('/update-detail', ['uses' => 'App\Http\Controllers\BastController@update_detail', 'as' => 'update-detail']);
        Route::get('/delete-detail/{idbast}/{id}', ['uses' => 'App\Http\Controllers\BastController@delete_detail', 'as' => 'delete-detail']);
        Route::get("/print/{id}", ['uses' => 'App\Http\Controllers\BastController@print', 'as' => 'print']);
    });

    Route::group(["prefix" => "mom", "as" => "mom."], function () {
        Route::get('/', ['uses' => 'App\Http\Controllers\MomController@index', 'as' => 'index']);
        Route::get("/datatable", ['uses' => 'App\Http\Controllers\MomController@datatable', 'as' => 'datatable']);
        Route::get('/print/{id}', ['uses' => 'App\Http\Controllers\MomController@print', 'as' => 'print']);
        Route::get('/create', ['uses' => 'App\Http\Controllers\MomController@create', 'as' => 'create']);
        Route::get('/bast-project',['uses' => 'App\Http\Controllers\MomController@BastbyProject','as' => 'getBast']);
        Route::post('/store', ['uses' => 'App\Http\Controllers\MomController@store', 'as' => 'store']);
        Route::post('/upload', ['uses' => 'App\Http\Controllers\MomController@upload', 'as' => 'upload']);
        Route::get('/edit/{id}', ['uses' => 'App\Http\Controllers\MomController@edit', 'as' => 'edit']);
        Route::put('/update', ['uses' => 'App\Http\Controllers\MomController@update', 'as' => 'update']);
        Route::get('/delete/{id}', ['uses' => 'App\Http\Controllers\MomController@delete', 'as' => 'delete']);
    });

    Route::group(["prefix" => "settings", "as" => "settings."], function () {
        Route::get('/', ['uses' => 'App\Http\Controllers\settingsController@index', 'as' => 'index']);
        Route::post('/store', ['uses' => 'App\Http\Controllers\settingsController@store', 'as' => 'store']);
    });

    Route::get('/bast_link/{id}/{projectid}', [BastController::class, 'bast_link']);
    Route::get('/signature_url/{id}', [BastController::class, 'signature_url'])->name('signature_url');
    Route::get('/signature_public/{id}', [BastController::class, 'signature_public']);
    Route::put('/simpan_signature/{id}{idsig}', [BastController::class, 'simpan_signature']);
    Route::put('/simpan_detail/{id}{bastid}', [BastController::class, 'simpan_detail']);
    Route::post('/delete_signature/{id}{idsig}', [BastController::class, 'delete_signature']);
});


require __DIR__ . '/auth.php';
Route::get('/logout', ['as' => 'logout', 'uses' => 'App\Http\Controllers\Auth\AuthenticatedSessionController@destroy']);
