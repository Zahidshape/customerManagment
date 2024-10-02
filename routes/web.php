<?php
use App\Http\Controllers\UploadPageController;

Route::get('/', function () {
    return view('welcome'); 
});


Route::get('upload', [UploadPageController::class, 'showUploadForm'])->name('upload.form');
Route::post('upload', [UploadPageController::class, 'uploadFile'])->name('upload.file');


Route::get('upload/download-unique-customers', [UploadPageController::class, 'downloadUniqueCustomers'])->name('download.unique.customers');
Route::get('/upload/download-duplicate-customers', [UploadPageController::class, 'downloadDuplicateCustomers'])->name('download.duplicate.customers');

// Route::get('upload/download-duplicates/{uploadId}', [UploadPageController::class, 'downloadDuplicates'])->name('download.duplicates');



