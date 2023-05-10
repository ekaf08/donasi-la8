<?php

use App\Http\Controllers\{
    AppController,
    CategoryController,
    DashboardController,
    CampaignController,
    DonationController,
    DonaturController,
    FileUploadController,
    SettingController,
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
    'middleware' => ['auth', 'getUserMenu']
], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // route untuk filepond
    Route::post('/upload', [FileUploadController::class, 'store'])->name('upload');
    Route::delete('/revert', [FileUploadController::class, 'delete'])->name('revert');

    Route::group([
        'middleware' => ['getUserMenu']
    ], function () {
        // route untuk menu kategori
        Route::resource('/category', CategoryController::class);

        // route untuk menu campaign/projek
        Route::get('/campaign/data', [CampaignController::class, 'data'])->name('campaign.data');
        Route::get('/campaign/detail/{id}', [CampaignController::class, 'detail'])->name('campaign.detail');
        Route::resource('/campaign', CampaignController::class)->except(['create', 'edit']);

        // route untuk setting
        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::get('/setting/{id}', [SettingController::class, 'update'])->name('setting.update');

        // route untuk donasi
        Route::resource('/donation', DonationController::class);

        // route untuk donatur
        Route::resource('/donatur', DonaturController::class);

        // route untuk menu web management
        Route::get('/setup/data', [AppController::class, 'data'])->name('setup.data');
        Route::post('/setup/menu', [AppController::class, 'menu'])->name('setup.menu');
        Route::post('/setup/subMenu', [AppController::class, 'subMenu'])->name('setup.subMenu');
        Route::post('/setup/configMenu', [AppController::class, 'configMenu'])->name('setup.configMenu');
        Route::post('/setup/urutanMenu', [AppController::class, 'urutanMenu'])->name('setup.urutanMenu');
        Route::delete('/setup/hapus_menu', [AppController::class, 'hapus_menu'])->name('setup.hapus_menu');
        Route::post('/setup/restore_menu', [AppController::class, 'restore_menu'])->name('setup.restore_menu');
        Route::delete('/setup/hapus_subMenu/{id}', [AppController::class, 'hapus_subMenu'])->name('setup.hapus_subMenu');
        Route::resource('/setup', AppController::class)->except('create', 'edit');
    });
});
