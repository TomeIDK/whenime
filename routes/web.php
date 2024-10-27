<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})-> name("home");

Route::get('/about', function () {
    return view('about');
})-> name("about");

Route::get('/faq', function () {
    return view('faq');
})-> name("faq");

Route::get('/login', function () {
    return view('login');
})-> name("login");

Route::get('/register', function () {
    return view('register');
})-> name("register");

Route::get('/forgot-password', function () {
    return view('forgot-password');
})-> name("forgot-password");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
