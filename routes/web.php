<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\StateController;

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

// route for resource master
Route::resource('state', StateController::class)->except(['show']);
Route::post('state/import', [StateController::class, 'import'])->name('state.import');