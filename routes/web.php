<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ApplicationController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Middleware for authentication
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Students
Route::resource('students', StudentController::class)
    ->only(['index', 'store', 'create', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);


// Companies
Route::resource('companies', CompanyController::class)
    ->only(['index', 'store', 'create', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);


// Offers
Route::resource('offers', OfferController::class)
    ->only(['index', 'store', 'create', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);
Route::get('/offers/filter', [OfferController::class, 'filter'])
    ->name('offers.filter');


// Applications
Route::post('/applications', [ApplicationController::class, 'store']);
Route::get('/applications', [ApplicationController::class, 'index']);

Route::get('/applications/{studentId}/{offerId}', [ApplicationController::class, 'show'])
    ->where('studentId', '[0-9]+')
    ->where('offerId', '[0-9]+');

Route::get('/applications/student/{studentId}', [ApplicationController::class, 'showByStudent']);
Route::get('/applications/offer/{offerId}', [ApplicationController::class, 'showByOffer']);

Route::patch('/applications/{studentId}/{offerId}', [ApplicationController::class, 'update'])
    ->where('studentId', '[0-9]+')
    ->where('offerId', '[0-9]+');

Route::delete('/applications/{studentId}/{offerId}', [ApplicationController::class, 'destroy'])
    ->where('studentId', '[0-9]+')
    ->where('offerId', '[0-9]+');

require __DIR__.'/auth.php';
