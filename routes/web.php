<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Ruta protegida por un Middleware
Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard');
    
})->name('dashboard');





Route::get('/administrador', function () {
    return view('administrador');
});

Route::get('/menu', function () {
    return view('menu');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



