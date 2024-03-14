<?php

use App\Constants\UserRole;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::name('public.')->group(function () {
    Route::get('/', [PublicController::class, 'index'])->name('index');
    Route::get('/assessments', [PublicController::class, 'assessments'])->name('assessments');
    Route::get('/assessments/{assessment}', [PublicController::class, 'assessment'])->name('assessment');
    Route::post('/answers/{assessment}/{student}', [AnswerController::class, 'store'])->name('answers.store');
});

Route::name('auth.')->group(function () {
    Route::get('/login', [AuthController::class, 'login_index'])->name('login.index');
    Route::post('/login/authenticate', [AuthController::class, 'login_authenticate'])->name('login.authenticate');
});

Route::prefix('dashboard')->name('dashboard.')->middleware(['web', 'auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::prefix('master')->name('master.')->middleware(['roles:' . UserRole::ADMIN])->group(function () {
        Route::resource('/users', UserController::class)->names('user');
        Route::put('/users/{user}/update/password', [UserController::class, 'update_password'])->name('user.update.password');
        Route::post('/users/import', [UserController::class, 'import'])->name('user.import');
        Route::get('/users/import/example', [UserController::class, 'import_example'])->name('user.import.example');
        Route::get('/users/export/download', [UserController::class, 'export'])->name('user.export');
        Route::resource('/assessments', AssessmentController::class)->names('assessments');
        Route::get('/assessments/{assessment}/preview', [AssessmentController::class, 'preview'])->name('assessments.preview');
        Route::get('/assessments/{assessment}/load-file', [FileController::class, 'loadFileCover']);
        Route::post('/questions/{assessment}/store', [QuestionController::class, 'store'])->name('questions.store');
    });
    Route::prefix('admins')->name('admins.')->middleware(['roles:' . UserRole::MANAGER])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/create', [AdminController::class, 'create'])->name('create');
        Route::post('/store', [AdminController::class, 'store'])->name('store');
        Route::get('/{user}', [AdminController::class, 'show'])->name('show');
        Route::get('/{user}/edit', [AdminController::class, 'edit'])->name('edit');
        Route::put('/{user}/update', [AdminController::class, 'update'])->name('update');
        Route::put('/{user}/update/password', [AdminController::class, 'update_password'])->name('update.password');
        Route::delete('/{user}/destroy', [AdminController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('reports')->name('reports.')->middleware(['roles:' . UserRole::MANAGER])->group(function () {
        Route::get('/users', [ReportController::class, 'users'])->name('users');
        Route::get('/users/pdf/preview', [ReportController::class, 'users_pdf_preview'])->name('users.pdf.preview');
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
