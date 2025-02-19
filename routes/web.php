<?php

use App\Constants\UserRole;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::name('public.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard.index');
    });
});

Route::name('auth.')->group(function () {
    Route::get('/login', [AuthController::class, 'login_index'])->name('login.index');
    Route::post('/login/authenticate', [AuthController::class, 'login_authenticate'])->name('login.authenticate');
});

Route::prefix('dashboard')->name('dashboard.')->middleware(['web', 'auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::prefix('master')->name('master.')->middleware(['roles:' . UserRole::ADMIN])->group(function () {
        Route::resource('/users', UserController::class)->names('users');
        Route::patch('/users/{user}/update/account', [UserController::class, 'update_account'])->name('users.update.account');
        Route::patch('/users/{user}/update/password', [UserController::class, 'update_password'])->name('users.update.password');
        Route::resource('/pics', PicController::class)->names('pics');
    });
    Route::resource('/activities', ActivityController::class)->names('activities');
    Route::patch('/activities/{activity}/confirm', [ActivityController::class, 'confirm'])->name('activities.confirm');
    Route::patch('/activities/{activity}/notify-pic', [ActivityController::class, 'notifyPic'])->name('activities.notifyPic');
    Route::resource('/documentations', DocumentationController::class)->names('documentations');
    Route::resource('/messages', MessageController::class)->only('store')->names('messages');
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/users', [ReportController::class, 'users'])->name('users');
        Route::get('/users/pdf/preview', [ReportController::class, 'users_pdf_preview'])->name('users.pdf.preview');
        Route::get('/activities/pdf/preview', [ReportController::class, 'activities_pdf_preview'])->name('activities.pdf.preview');
    });
    Route::prefix('profile')->name('profile.')->middleware([])->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
        Route::put('/avatar', [ProfileController::class, 'avatar'])->name('avatar');
    });
    Route::prefix('security')->name('security.')->middleware([])->group(function () {
        Route::get('/', [SecurityController::class, 'index'])->name('index');
        Route::put('/update/password', [SecurityController::class, 'update_password'])->name('update.password');
    });
    Route::prefix('setting')->name('setting.')->middleware([])->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::put('/update', [SettingController::class, 'update'])->name('update');
        Route::get('/load-file/auth-bg', [FileController::class, 'loadFileAuthBg']);
        Route::get('/load-file/report-logo', [FileController::class, 'loadFileReportLogo']);
        Route::get('/load-file/app-logo', [FileController::class, 'loadFileAppLogo']);
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
