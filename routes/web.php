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

    Route::prefix('company')->middleware('role:ADMIN')->controller(CompanyController::class)->group(function () {
        Route::get('/', 'index')->name('company');
        Route::get('/create', 'create')->name('company.create');
        Route::post('/create', 'store')->name('company.store');
        Route::get('/{company}', 'show')->name('company.show');
        Route::put('/{company}', 'update')->name('company.update');

        Route::prefix('/{company}/user')->group(function () {
            Route::get('/register', 'userRegister')->name('company.user.register');
            Route::get('/{user}', 'userShow')->name('company.user.show');
            Route::post('/register', 'userStore')->name('company.user.store');
        });
    });
});

require __DIR__ . '/auth.php';
