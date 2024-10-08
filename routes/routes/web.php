<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/upload', function () {
//     return view('upload');
// })->middleware(['auth', 'verified'])->name('uploadfile');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('upload', [UploadPageController::class, 'showUploadForm'])->name('upload.form');
Route::post('upload', [UploadPageController::class, 'uploadFile'])->name('upload.file');


Route::get('upload/download-unique-customers', [UploadPageController::class, 'downloadUniqueCustomers'])->name('download.unique.customers');
Route::get('/upload/download-duplicate-customers', [UploadPageController::class, 'downloadDuplicateCustomers'])->name('download.duplicate.customers');

require __DIR__.'/auth.php';
