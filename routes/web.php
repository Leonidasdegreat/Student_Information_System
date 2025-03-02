<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentViewsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware(['auth:student'])->group(function () {

    Route::get('/studentviews', [StudentViewsController::class, 'index'])->name('studentviews.index');
   

});


Route::middleware(['auth:web'])->group(function () {

Route::resource('students', StudentController::class)->middleware(['auth', 'verified']);
Route::resource('subjects', SubjectController::class)->middleware(['auth', 'verified']);
Route::resource('enrollments', EnrollmentController::class)->middleware(['auth', 'verified']);
Route::get('/grades', [GradeController::class, 'index'])->name('grades.index')->middleware(['auth', 'verified']);
Route::put('/grades/{enrollmentId}', [GradeController::class, 'update'])->name('grades.update')->middleware(['auth', 'verified']);
Route::delete('/grades/{id}', [GradeController::class, 'destroy'])->name('grades.destroy')->middleware(['auth', 'verified']);

Route::post('/logout', [AuthController::class, 'destroy'])->name('logout')->middleware(['auth', 'verified']);

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





require __DIR__.'/auth.php';
