<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('profile')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'edit')->name('profile.edit');
        Route::patch('/', 'update')->name('profile.update');
        Route::delete('/', 'destroy')->name('profile.destroy');
    });

    Route::prefix('company')->controller(CompanyController::class)->group(function () {
        Route::get('/', 'index')->name('company');
        Route::get('/create', 'create')->name('company.create');
        Route::get('/{company}', 'show')->name('company.show');
        Route::post('/', 'store')->name('company.store');
    });
});

require __DIR__ . '/auth.php';
