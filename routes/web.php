<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('super_admin', function () {
    return view('super_admin.index');
})->name('super_admin')->middleware('superAdminAuth');

Route::get('admin', function () {
    return view('admin.index');
})->name('admin')->middleware('adminAuth');

Route::get('dept', function () {
    return view('dept.index');
});

Route::get('staff', function () {
    return view('staff.index');
})->name('staff')->middleware('staffAuth');

Route::get('client', function () {
    return view('client.index');
})->name('client')->middleware('clientAuth');
