<?php

use App\Livewire\Scanner;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/scan', Scanner::class);

Route::get('migrate', function () {
    Artisan::call('migrate');
    return 'Migrated';
});

Route::get('storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage linked';
});