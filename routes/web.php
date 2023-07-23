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
    ->middleware(['auth', 'verified', 'is_student']);


// Offers
Route::resource('offers', OfferController::class)
    ->only(['index', 'store', 'create', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);
Route::get('/offers/filter', [OfferController::class, 'filter'])
    ->name('offers.filter');


// Applications
Route::post('/applications/apply', [ApplicationController::class, 'apply']);
Route::get('/applications/student/{studentId}', [ApplicationController::class, 'applications']);
Route::get('/applications/offer/{offer}', [ApplicationController::class, 'applicants']);
Route::put('/applications/accept', [ApplicationController::class, 'accept']);
Route::put('/applications/update', [ApplicationController::class, 'update']);
Route::delete('/applications/cancel', [ApplicationController::class, 'cancel']);


require __DIR__.'/auth.php';
