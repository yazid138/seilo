<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HireController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Models\Job;
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
    $jobs = Job::query()->limit(5)->get();
    return view('welcome', compact('jobs'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('profile')->controller(ProfileController::class)->group(function () {
        Route::get('/detail', 'detail')->name('profile.detail');
        Route::post('/', 'store')->name('profile.store');
        Route::get('/edit', 'edit')->name('profile.edit');
        Route::patch('/', 'update')->name('profile.update');
        Route::delete('/', 'destroy')->name('profile.destroy');
    });

    Route::prefix('company')->controller(CompanyController::class)->group(function () {
        Route::get('/', 'index')->middleware('role:ADMIN,COMPANY')->name('company');

        Route::middleware('role:ADMIN')->group(function () {
            Route::get('/create', 'create')->name('admin.company.create');
            Route::post('/create', 'store')->name('admin.company.store');
            Route::get('/{company}', 'show')->name('admin.company.show');
            Route::put('/{company}', 'update')->name('admin.company.update');

            Route::prefix('/{company}/user')->group(function () {
                Route::get('/register', 'userRegister')->name('admin.company.user.register');
                Route::get('/{user}', 'userShow')->name('admin.company.user.show');
                Route::post('/register', 'userStore')->name('admin.company.user.store');
            });
        });

        Route::middleware('role:COMPANY')->group(function () {
            Route::put('/', 'update2')->name('company.company.update');

            Route::prefix('/user')->group(function () {
                Route::get('/register', 'userRegister2')->name('company.company.user.register');
                Route::get('/{user}', 'userShow2')->name('company.company.user.show');
                Route::post('/register', 'userStore2')->name('company.company.user.store');
            });

        });
    });

    Route::prefix('job')->controller(JobController::class)->group(function () {
        Route::middleware('role:COMPANY')->group(function () {
            Route::get('/create', 'create')->name('company.job.create');
            Route::post('/', 'store')->name('company.job.store');
            Route::get('/{job}/update', 'edit')->name('company.job.edit');
            Route::put('/{job}', 'update')->name('company.job.update');
            Route::delete('/{job}', 'destroy')->name('company.job.destroy');
        });
    });

    Route::prefix('lamar')->controller(HireController::class)->group(function () {
        Route::get('/status', 'index')->name('hire');
        Route::get('/{hire}', 'show')->name('hire.detail');

        Route::middleware('role:COMPANY')->group(function () {
            Route::put('/{hire}', 'update')->name('company.hire.update');
        });

        Route::middleware(['role:USER', 'existsProfile'])->group(function () {
            Route::get('/{job}/add', 'create')->name('user.hire.create');
            Route::post('/{job}', 'store')->name('user.hire.store');
        });
    });
});

Route::get('/job', [JobController::class, 'index'])->name('job');
Route::get('/job/{job}', [JobController::class, 'show'])->name('company.job.show');

require __DIR__ . '/auth.php';
