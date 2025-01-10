<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/debugtaikucing', [PostController::class, 'debugtaikucing']);

Route::get('/black', function() {
    return view('welcome-dark');
});
