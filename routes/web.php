<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MySchedulesController;
use App\Http\Controllers\ScheduleItemController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\OwnerOrAdminMiddleware;
use Illuminate\Support\Facades\Route;

// Public Routes

// Home
Route::get('/', function () {
    return view('home');
})-> name("home");


// FAQ
Route::get('/faq',  [FAQController::class, 'index'])->name('faq');

// Contact 
Route::get('/contact', [ContactFormController::class, 'create'])
    ->name('contact');

Route::post('/contact', [ContactFormController::class, 'store'])
    ->middleware('throttle:5,10')
    ->name('contact.store');

// Profile 
Route::get('/profile/{username}', [ProfileController::class, 'show'])->name('profile');
Route::get('/profile/{username}/schedules/{scheduleName}', [ProfileController::class, 'showSchedule'])->name('profile-schedule.show');

Route::middleware(['auth', OwnerOrAdminMiddleware::class])->group(function () { // Only allow access if user is owner or an admin
    Route::get('/profile/{username}/edit', [ProfileController::class, 'edit'])
    ->name('profile.edit');
    Route::patch('/profile/{username}', [ProfileController::class, 'update'])
    ->name('profile.update');
});

// News 
Route::get('/news', [NewsController::class, 'index'])-> name("news");
Route::get('/news/latest', [NewsController::class, 'index'])->name('news.latest');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');

// My schedules
Route::middleware(['auth'])->group(function () {
    Route::get('/my-schedules', [MySchedulesController::class, 'index'])
    ->name('my-schedules');
    Route::get('/my-schedules/{scheduleName}', [MySchedulesController::class, 'edit'])
    ->name('my-schedules.edit');
    Route::patch('/my-schedules/{scheduleName}', [MySchedulesController::class, 'update'])
    ->name('my-schedules.update');
    Route::delete('/my-schedules/delete/{id}', [MySchedulesController::class, 'destroy'])
    ->name('my-schedules.destroy');
    Route::post('/my-schedules/store', [MySchedulesController::class, 'store'])
    ->name('my-schedules.store');
    Route::post('/schedule-item/{scheduleName}/add', [ScheduleItemController::class, 'store'])
    ->name('schedule-item.store');
    Route::patch('/schedule-item/{id}', [ScheduleItemController::class, 'update'])
    ->name('schedule-item.update');
    Route::delete('/schedule-item/delete/{id}', [ScheduleItemController::class, 'destroy'])
    ->name('schedule-item.destroy');
});


// Admin Only Routes
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    // FAQ
    Route::get('/admin/faq',  [FAQController::class, 'indexAdmin'])->name('faq.admin');
    Route::get('/faq/edit/{category}', [FAQController::class, 'edit'])->name('faq.edit');
    Route::patch('/faq/update/{category}', [FAQController::class, 'update'])->name('faq.update');
    Route::patch('/faq/update/question/{questionId}', [FAQController::class, 'updateQuestion'])->name('faq.updateQuestion');
    Route::post('/faq/category/store', [FAQController::class, 'storeCategory'])->name('faq.storeCategory');
    Route::post('/faq/question/store', [FAQController::class, 'storeQuestion'])->name('faq.storeQuestion');
    Route::delete('/faq/category/delete/{id}', [FAQController::class, 'destroyCategory'])->name('faq.destroyCategory');
    Route::delete('/faq/question/delete/{id}', [FAQController::class, 'destroyQuestion'])->name('faq.destroyQuestion');

    // News
    Route::get('/admin/news', [NewsController::class, 'indexAdmin'])->name('news.admin');
    Route::get('/admin/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/admin/news/store', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::patch('/news/{id}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');

    // Admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin-dashboard');

    // Users
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin-users');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin-users.store');
    Route::patch('/admin/users/{user}/toggle-admin', [UserController::class, 'toggleAdmin'])->name('admin-users.toggleAdmin');
    Route::delete('/admin/users/delete/{id}', [UserController::class, 'destroy'])->name('admin-users.destroy');

    // Contact
    Route::get('/admin/forms/unread', [ContactFormController::class, 'indexUnread'])->name('contact.unread');
    Route::get('/admin/forms/read', [ContactFormController::class, 'indexRead'])->name('contact.read');
    Route::get('/admin/forms/solved', [ContactFormController::class, 'indexSolved'])->name('contact.solved');
    Route::get('/admin/forms/view/{id}', [ContactFormController::class, 'show'])->name('contact.show');
    Route::patch('/admin/forms/update/{id}', [ContactFormController::class, 'toggleRead'])->name('contact.toggleRead');
    Route::patch('/admin/forms/update-status/{id}', [ContactFormController::class, 'toggleSolved'])->name('contact.toggleSolved');
    Route::delete('/admin/forms/delete/{id}', [ContactFormController::class, 'destroy'])->name('contact.destroy');
});

require __DIR__.'/auth.php';
