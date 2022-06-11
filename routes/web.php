<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ArchiveCategoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;

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

// auth

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect('');
})->middleware(['auth'])->name('dashboard');

Route::get('/forget', function() {
    return view('auth.forgot-password');
})->name('password.request');

require __DIR__.'/auth.php';

Route::resource('', ArchiveCategoryController::class)->middleware(['auth']);

Route::resource('archive', ArchiveController::class)->middleware(['auth']);

Route::get('archive', function () {
    return redirect('');
});

Route::get('archive/c/{archiveCategory}', [ArchiveCategoryController::class, 'show'])->name('category.show')->middleware(['auth']);

Route::get('archive/{id}/edit', [ArchiveController::class, 'edit'])->name('archive.edit')->middleware(['auth']);

Route::post('archive/{id}/create', [ArchiveController::class, 'create'])->name('archive.create')->middleware(['auth']);

Route::get('/archive/{archive}', [ArchiveController::class, 'show'])->name('archive.show')->middleware(['auth']);

Route::patch('/archive/{archive}/update', [ArchiveController::class, 'update'])->name('archive.update')->middleware(['auth']);

Route::get('archive/{id}/delete', [ArchiveController::class, 'destroy'])->middleware(['auth']);

Route::get('archive/download/{id}', [ArchiveController::class, 'download'])->middleware(['auth']);

// admin

Route::get('category', [ArchiveCategoryController::class, 'admin_index'])->name('category.index')->middleware(['auth']);

Route::get('category/create', [ArchiveCategoryController::class, 'admin_create'])->middleware(['auth']);

Route::get('category/{archiveCategory}', [ArchiveCategoryController::class, 'admin_show'])->name('category.detail')->middleware(['auth']);

Route::get('category/{id}/delete', [ArchiveCategoryController::class, 'destroy'])->middleware(['auth']);

Route::resource('user', UserController::class)->middleware(['auth']);

Route::get('user/{user}', [UserController::class, 'show'])->name('user.show')->middleware(['auth']);

Route::post('user/{user}/reset', [UserController::class, 'reset'])->name('user.reset')->middleware(['auth']);

Route::get('user/{user}/delete', [UserController::class, 'destroy'])->name('user.delete')->middleware(['auth']);

Route::get('user/{user}/privilege', [UserController::class, 'access'])->name('user.access')->middleware(['auth']);

Route::post('user/{id}/privilege/grant', [UserController::class, 'grant'])->name('user.grant')->middleware(['auth']);

Route::get('privilege/revoke/{id}', [UserController::class, 'revoke'])->name('user.revoke')->middleware(['auth']);

Route::get('privilege/modify/{id}', [UserController::class, 'modify'])->name('user.modify')->middleware(['auth']);

Route::patch('privilege/alter/{id}', [UserController::class, 'alter'])->name('user.alter')->middleware(['auth']);