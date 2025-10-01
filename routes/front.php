<?php

use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\MainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::name('front.')
    ->prefix(LaravelLocalization::setLocale())
    ->middleware([ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ])
    ->group(function () {
        Route::get('/', [MainController::class, 'home'])->name('home');
        Route::resource('contacts', ContactController::class)->only('store');
        Route::resource('blogs', BlogController::class)->only('index', 'show');
        Route::get('blogs/{last_blog_id}/{limit}', [BlogController::class, 'getMoreBlogs'])->name('blogs.get');
});