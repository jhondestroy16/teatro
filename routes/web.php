<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\SalaController;
use App\Http\Controllers\SillaController;
use App\Http\Controllers\ReservaController;


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
})->name('inicio');

Auth::routes();
Route::resource('salas', SalaController::class)->middleware('can:salas');
Route::resource('sillas', SillaController::class)->middleware('can:sillas');
Route::resource('reservaciones', ReservaController::class)->middleware('can:reservaciones');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
