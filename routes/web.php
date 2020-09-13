<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('test', function () {
    $cat = App\Models\Category::find(1);
    $cat -> makeVisible(['translations']);
    return $cat;
});


Route::get('/login', 'Dashboard\LoginController@login')->name('login');
