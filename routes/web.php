<?php

use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\NewsController;
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
Route::get('/faq',  [FAQController::class, 'index'])->name('faq');

Route::get('/faq/edit/{category}', [FAQController::class, 'edit'])->name('faq.edit');

Route::patch('/faq/update/{category}', [FAQController::class, 'update'])->name('faq.update');
Route::delete('/faq/delete/{id}', [FAQController::class, 'destroy'])->name('faq.destroy');
Route::post('/faq/store', [FAQController::class, 'store'])->name('faq.store');

// Contact Routes
Route::get('/contact', [ContactFormController::class, 'create'])
    ->name('contact');

Route::post('/contact', [ContactFormController::class, 'store'])
    ->name('contact.store');

// Profile Routes
Route::get('/profile/{username}', [ProfileController::class, 'show'])->name('profile');


Route::middleware('auth')->group(function () {
    Route::get('/profile/{username}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/{username}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// News Routes
Route::get('/news/latest', [NewsController::class, 'index'])->name('news.latest');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
Route::patch('/news/{id}', [NewsController::class, 'update'])->name('news.update');
Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');

require __DIR__.'/auth.php';
