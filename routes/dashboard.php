<?php

use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\ContactUsController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\PartnersController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\ServicesController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\WebsiteSettingsController;
use App\Models\Blog;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::prefix(LaravelLocalization::setLocale())
    ->middleware([ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ])
    ->group(function() {
        
    Route::name('dashboard.')->prefix('dashboard')->group(function () {
        include 'auth.php';

        Route::middleware('auth')->group(function () {
            Route::get('/', [HomeController::class, 'index'])->name('index');
            Route::post('ckEditorUploadImage', [BlogController::class, 'uploadImage']);

            Route::resource('users', UsersController::class);
            Route::resource('roles', RolesController::class);
            Route::resource('blogs', BlogController::class);
            Route::resource('website_setting', WebsiteSettingsController::class);
            Route::resource('contact-us', ContactUsController::class);
            Route::put('contact-us/{contact_us}/approve', [ContactUsController::class, 'approve']);
            Route::put('contact-us/{contact_us}/declince', [ContactUsController::class, 'declince']);
            Route::resource('partners', PartnersController::class);
            Route::resource('services', ServicesController::class);
        });
    });
});