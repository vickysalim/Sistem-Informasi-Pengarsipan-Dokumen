<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ArchiveCategoryController;
use App\Http\Controllers\FileController;

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

Route::get('', function () {
    return redirect('archive');
});

Route::resource('archive', ArchiveController::class);

Route::get('archive/c/{archiveCategory}', [ArchiveCategoryController::class, 'show'])->name('category.show');

Route::get('archive/{id}/edit', [ArchiveController::class, 'edit'])->name('archive.edit');

Route::get('/archive/{archive}', [ArchiveController::class, 'show'])->name('archive.show');

Route::patch('/archive/{archive}/update', [ArchiveController::class, 'update'])->name('archive.update');

Route::get('archive/{id}/delete', [ArchiveController::class, 'destroy']);

Route::get('archive/download/{id}', [ArchiveController::class, 'download']);