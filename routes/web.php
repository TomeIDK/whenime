<?php

use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', function () {
    return view('home');
})-> name("home");

// News Routes
Route::get('/news', function () {
    return view('news');
})-> name("news");

// FAQ Routes

// Public FAQ view
Route::get('/faq',  [FAQController::class, 'index'])->name('faq');

// Admin edit FAQ view
Route::get('/faq/edit/{category}', [FAQController::class, 'edit'])
    // ->middleware('can:edit-faq')    
    ->name('faq.edit');

// FAQ CRUD
Route::put('/faq/update/{id}', [FAQController::class, 'update'])->name('faq.update');
Route::delete('/faq/delete/{id}', [FAQController::class, 'destroy'])->name('faq.destroy');
Route::post('/faq/store', [FAQController::class, 'store'])->name('faq.store');



// Contact Routes
Route::get('/contact', [ContactFormController::class, 'create'])
    ->name('contact');

Route::post('/contact', [ContactFormController::class, 'store'])
    ->name('contact.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
