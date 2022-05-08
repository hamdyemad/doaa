<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\PrayerController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\VoiceController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth'], function() {
    Route::redirect('/', '/admin/dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile/{user}', [SettingsController::class, 'profile'])->name('profile');
    Route::patch('/profile/{user}', [SettingsController::class, 'update_profile'])->name('profile_update');

    // Categories
    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function() {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
        Route::patch('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });

    // Prayers
    Route::group(['prefix' => 'prayers', 'as' => 'prayers.'], function() {
        Route::get('/', [PrayerController::class, 'index'])->name('index');
        Route::post('/', [PrayerController::class, 'store'])->name('store');
        Route::get('/create', [PrayerController::class, 'create'])->name('create');
        Route::get('/edit/{prayer}', [PrayerController::class, 'edit'])->name('edit');
        Route::patch('/{prayer}', [PrayerController::class, 'update'])->name('update');
        Route::delete('/{prayer}', [PrayerController::class, 'destroy'])->name('destroy');
    });
    // Headers
    Route::group(['prefix' => 'headers', 'as' => 'headers.'], function() {
        Route::get('/', [HeaderController::class, 'index'])->name('index');
        Route::post('/', [HeaderController::class, 'store'])->name('store');
        Route::get('/create', [HeaderController::class, 'create'])->name('create');
        Route::get('/edit/{header}', [HeaderController::class, 'edit'])->name('edit');
        Route::patch('/{header}', [HeaderController::class, 'update'])->name('update');
        Route::delete('/{header}', [HeaderController::class, 'destroy'])->name('destroy');
    });

    // Settings
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function() {
        Route::get('/edit', [SettingsController::class, 'edit'])->name('edit');
        Route::patch('/update', [SettingsController::class, 'update'])->name('update');
    });


  	// Voices
    Route::group(['prefix' => 'voices', 'as' => 'voices.'], function() {
        Route::get('/', [VoiceController::class, 'index'])->name('index');
        Route::post('/', [VoiceController::class, 'store'])->name('store');
        Route::get('/create', [VoiceController::class, 'create'])->name('create');
        Route::get('/edit/{voice}', [VoiceController::class, 'edit'])->name('edit');
        Route::delete('/remove_voice_file/{voice}', [VoiceController::class, 'remove_voice_file'])->name('remove_voice_file');
        Route::post('/{voice}', [VoiceController::class, 'update'])->name('update');
        Route::delete('/{voice}', [VoiceController::class, 'destroy'])->name('destroy');
    });
    // Videos
    Route::group(['prefix' => 'videos', 'as' => 'videos.'], function() {
        Route::get('/', [VideoController::class, 'index'])->name('index');
        Route::post('/', [VideoController::class, 'store'])->name('store');
        Route::get('/create', [VideoController::class, 'create'])->name('create');
        Route::get('/edit/{video}', [VideoController::class, 'edit'])->name('edit');
        Route::delete('/remove_video_file/{video}', [VideoController::class, 'remove_video_file'])->name('remove_video_file');
        Route::post('/{video}', [VideoController::class, 'update'])->name('update');
        Route::delete('/{video}', [VideoController::class, 'destroy'])->name('destroy');
    });







});

