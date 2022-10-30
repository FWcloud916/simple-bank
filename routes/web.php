<?php

use App\Http\Controllers\AccountRecordViewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::controller(AccountRecordViewController::class)->group(function () {
        Route::get('/accounts', 'index')->name('accounts.index');
        Route::get('/accounts/{user_id}', 'show')->name('accounts.show');
    });

});

require __DIR__.'/auth.php';
