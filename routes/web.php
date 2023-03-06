<?php

use App\Http\Controllers\{
    CategoryController,
    DashboardController,
    CampaignController,
    FileUploadController,
};
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\XSS;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group([
    'middleware' => ['auth', 'role:admin,donatur']
], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // route untuk filepond
    Route::post('/upload', [FileUploadController::class, 'store'])->name('upload');
    Route::delete('/revert', [FileUploadController::class, 'delete'])->name('revert');

    Route::group([
        'middleware' => ['role:admin']
    ], function () {
        Route::resource('/category', CategoryController::class);
        Route::resource('/campaign', CampaignController::class)->except(['create', 'edit']);
    });

    Route::group([
        'middleware' => 'role:donatur'
    ], function () {
        //
    });
});
