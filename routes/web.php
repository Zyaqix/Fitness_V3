<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\TaskController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
        Route::get('/admin/edit/{task}', [AdminController::class, 'edit'])->name('admin.edit');
        Route::put('/admin/update/{task}', [AdminController::class, 'update'])->name('admin.update');
        Route::delete('/admin/destroy/{task}', [AdminController::class, 'destroy'])->name('admin.destroy');
        Route::post('/admin/close/{task}', [AdminController::class, 'close'])->name('admin.close');
    });

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/search', [UserController::class, 'search'])->name('user.search');
    Route::post('/user/accept/{task}', [UserController::class, 'accept'])->name('user.accept');
    Route::post('/user/complete/{task}', [UserController::class, 'complete'])->name('user.complete');
});

Route::middleware(['admin'])->group(function () {
    // Admin jogosultságot igénylő route-ok itt vannak
});
