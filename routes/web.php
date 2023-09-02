<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExperienceController;

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
    Route::get('/show-profile/userId', [ProfileController::class, 'show'])->name('profile.show');
});

// Students
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/students/{student}', [StudentController::class, 'show'])->name('student.show');
    Route::get('/experience-create', [ExperienceController::class, 'create'])->name('experience.create');
    Route::post('/students/upload', [StudentController::class, 'upload'])->name('student.upload');
    Route::post('/experience', [ExperienceController::class, 'store'])->name('experience.store');
    Route::put('/experience/{experienceId}', [ExperienceController::class, 'update'])->name('experience.update');
    Route::delete('/experience/{experienceId}', [ExperienceController::class, 'destroy'])->name('experience.destroy');
});


// Companies
Route::get('companies/{companyId}', [CompanyController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('companies.show');

// Offers
Route::resource('offers', OfferController::class)
    ->only(['index', 'store', 'create', 'edit', 'show', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);
Route::get('/offers/filter', [OfferController::class, 'filter'])
    ->name('offers.filter');


// Applications
Route::middleware(['auth'])->group(function () {
    Route::get('/apply/{offerId}', [ApplicationController::class, 'apply'])->name('apply');
    Route::get('/applications', [ApplicationController::class, 'applications'])->name('applications');
    Route::get('/applicants/{offerId}', [ApplicationController::class, 'applicants'])->name('applicants');
    Route::put('/accept/{offerId}/{studentId}', [ApplicationController::class, 'accept'])->name('accept');
    Route::put('/update-application/{offerId}/{studentId}', [ApplicationController::class, 'update'])->name('update-application');
    Route::delete('/cancel-application/{offerId}', [ApplicationController::class, 'cancel'])->name('cancel-application');
});

// User verification
Route::middleware(['auth'])->group(function () {
    Route::get('/user-requests', [AdminController::class, 'userRequests'])->name('user-requests');
    Route::put('/verify-user', [AdminController::class, 'verifyUser'])->name('verify-user');
    Route::put('/reject-user', [AdminController::class, 'rejectUser'])->name('reject-user');    
    Route::get('/verified-users', [AdminController::class, 'verifiedUsers'])->name('verified-users');
});


require __DIR__.'/auth.php';
