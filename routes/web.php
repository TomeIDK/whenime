<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\JikanController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MySchedulesController;
use App\Http\Controllers\ScheduleItemController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\OwnerOrAdminMiddleware;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', function () {
    return view('home');
})-> name("home");

Route::get('/explore', [AnimeController::class, 'index'])->name('anime.index');

// FAQ
Route::prefix('/faq')->group(function () {
    Route::get('/',  [FAQController::class, 'index'])->name('faq');

    // Admin
    Route::middleware(['auth', AdminMiddleware::class])->group(function () {
        Route::get('/edit/{category}', [FAQController::class, 'edit'])->name('faq.edit');

        Route::patch('/update/{category}', [FAQController::class, 'update'])->name('faq.update');
        Route::patch('/update/question/{questionId}', [FAQController::class, 'updateQuestion'])->name('faq.updateQuestion');

        Route::post('/category/store', [FAQController::class, 'storeCategory'])->name('faq.storeCategory');
        Route::post('/question/store', [FAQController::class, 'storeQuestion'])->name('faq.storeQuestion');

        Route::delete('/category/delete/{id}', [FAQController::class, 'destroyCategory'])->name('faq.destroyCategory');
        Route::delete('/question/delete/{id}', [FAQController::class, 'destroyQuestion'])->name('faq.destroyQuestion');
    });
});

// Contact 
Route::prefix('/contact')->group(function () {
    Route::get('/', [ContactFormController::class, 'create'])
        ->name('contact');

    Route::post('/', [ContactFormController::class, 'store'])
        ->middleware('throttle:5,10')
        ->name('contact.store');
});

// Profile 
Route::prefix('/profile/{username}')->group(function () {
    Route::get('/', [ProfileController::class, 'show'])->name('profile');
    Route::get('/schedules/{season}-{year}', [ProfileController::class, 'showSchedule'])->name('profile-schedule.show');

    // Auth, Owner or Admin
    Route::middleware(['auth', OwnerOrAdminMiddleware::class])->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

        Route::patch('/', [ProfileController::class, 'update'])
        ->name('profile.update');
    });
});

// News 
Route::prefix('/news')->group(function () {
    Route::get('/', [NewsController::class, 'index'])-> name("news");
    Route::get('/latest', [NewsController::class, 'index'])->name('news.latest');

    Route::prefix('/{id}')->group(function () {
        Route::get('/', [NewsController::class, 'show'])->name('news.show');

        // Admin
        Route::middleware(['auth', AdminMiddleware::class])->group(function () {
            Route::get('/edit', [NewsController::class, 'edit'])->name('news.edit');

            Route::patch('/', [NewsController::class, 'update'])->name('news.update');

            Route::delete('/', [NewsController::class, 'destroy'])->name('news.destroy');
        });
    });
});

// My schedules
Route::prefix('/my-schedules')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/', [MySchedulesController::class, 'index'])
        ->name('my-schedules');
        Route::get('/{season}-{year}', [MySchedulesController::class, 'edit'])
        ->name('my-schedules.edit');

        Route::patch('/{season}-{year}', [MySchedulesController::class, 'update'])
        ->name('my-schedules.update');

        Route::post('/store', [MySchedulesController::class, 'store'])
        ->name('my-schedules.store');

        Route::delete('/delete/{id}', [MySchedulesController::class, 'destroy'])
        ->name('my-schedules.destroy');
    });
});

// Schedule Item
Route::prefix('/schedule-item')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::post('/{season}-{year}/add', [ScheduleItemController::class, 'store'])
        ->name('schedule-item.store');

        Route::patch('/{id}', [ScheduleItemController::class, 'update'])
        ->name('schedule-item.update');

        Route::delete('/delete/{id}', [ScheduleItemController::class, 'destroy'])
        ->name('schedule-item.destroy');
    });
});

// Admin
Route::prefix('/admin')->group(function () {
    Route::middleware(['auth', AdminMiddleware::class])->group(function () {
        Route::get('/faq',  [FAQController::class, 'indexAdmin'])->name('faq.admin');
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin-dashboard');

        // News
        Route::prefix('/news')->group(function () {
            Route::get('/', [NewsController::class, 'indexAdmin'])->name('news.admin');
            Route::get('/create', [NewsController::class, 'create'])->name('news.create');
            Route::post('/store', [NewsController::class, 'store'])->name('news.store');
        });


        // Users
        Route::prefix('/users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('admin-users');
            Route::post('/', [UserController::class, 'store'])->name('admin-users.store');
            Route::patch('/{user}/toggle-admin', [UserController::class, 'toggleAdmin'])->name('admin-users.toggleAdmin');
            Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('admin-users.destroy');
        });

        // Contact
        Route::prefix('/forms')->group(function () {
            Route::get('/unread', [ContactFormController::class, 'indexUnread'])->name('contact.unread');
            Route::get('/read', [ContactFormController::class, 'indexRead'])->name('contact.read');
            Route::get('/solved', [ContactFormController::class, 'indexSolved'])->name('contact.solved');
            Route::get('/view/{id}', [ContactFormController::class, 'show'])->name('contact.show');

            Route::patch('/update/{id}', [ContactFormController::class, 'toggleRead'])->name('contact.toggleRead');
            Route::patch('/update-status/{id}', [ContactFormController::class, 'toggleSolved'])->name('contact.toggleSolved');

            Route::delete('/delete/{id}', [ContactFormController::class, 'destroy'])->name('contact.destroy');
        });
    });
});


// Jikan API
Route::prefix('anime')->group(function () {
    Route::middleware(['auth', 'throttle:60,1'])->group(function () {
        Route::get('/{id}', [AnimeController::class, 'show'])->name('anime.show');
    });
});

require __DIR__.'/auth.php';
