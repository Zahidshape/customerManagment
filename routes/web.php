<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadPageController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Route::get('/admin', [AdminController::class, 'index']);

Route::get('/', [AdminController::class, 'index']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::group([ 'middleware' => 'auth'],function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    Route::get('/dashboard', [UploadPageController::class, 'showDashboard'])->name('dashboard');
    // Route::get('/dashboard', [UploadPageController::class, 'getAllfiles'])->name('dashboard');
    Route::get('/upload', [UploadPageController::class, 'showUploadForm'])->name('upload.form');
    Route::post('/upload', [UploadPageController::class, 'uploadFile'])->name('upload.file');
    
    Route::get('/customer', [UploadPageController::class, 'getAllCustomers'])->name('customer.list');
    Route::get('/files', [UploadPageController::class, 'getAllfiles'])->name('file.list');


    Route::get('/upload/download-unique-customers', [UploadPageController::class, 'downloadUniqueCustomers'])->name('download.unique.customers');
    Route::get('/upload/download-duplicate-customers', [UploadPageController::class, 'downloadDuplicateCustomers'])->name('download.duplicate.customers');
});
require __DIR__.'/auth.php';
