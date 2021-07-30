<?php

use Illuminate\Support\Facades\Route;

/**
 * Controllers
 */
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginsystemController;
use App\Http\Controllers\blsappointerController;

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

Route::get('/', [IndexController::class, 'FrontPage']);

Route::get('/login', [LoginsystemController::class, 'attemptauth'])->middleware("guest")->name('login');
Route::post('/login', [LoginsystemController::class, 'authenticate'])->middleware("guest");
Route::get('/logout', [LoginsystemController::class, 'logout'])->middleware("auth");

Route::get('/dashboard', [blsappointerController::class, 'dashboard']);
Route::get('/applicants/waiting-list', [blsappointerController::class, 'applicants']);
Route::get('/applicants/add-new', [blsappointerController::class, 'add_new']);
Route::post('/applicants/add-new', [blsappointerController::class, 'submitnewapplicants']);
Route::get('/bot/add-new-checker', [blsappointerController::class, 'add_checker']);
Route::post('/bot/add-new-checker', [blsappointerController::class, 'submit_checker']);
