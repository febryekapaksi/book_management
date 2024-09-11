<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;

Route::resource('borrowings', BorrowingController::class);

Route::resource('books', BookController::class);

Route::get('/', function () {
    return view('welcome');
});


