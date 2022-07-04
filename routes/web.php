<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoryblokController;
use App\Http\Middleware\SetLang;
use Illuminate\Support\Facades\Route;

Route::get('/story-flush', [StoryblokController::class, 'flush']);

Route::get('/{lang?}', [HomeController::class, 'index'])
    ->name('home')
    ->whereIn('lang', ['en-hk']);

Route::get('/{lang?}/eat', [StoryblokController::class, 'eat'])
    ->name('eat')
    ->middleware(SetLang::class)
    ->whereIn('lang', ['en-hk']);

Route::get('/{lang?}/{slug?}', StoryblokController::class)
    ->name('storyblok')
    ->middleware(SetLang::class)
    ->where('slug', '.*');
