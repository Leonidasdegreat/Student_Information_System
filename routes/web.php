<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentViewsController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:student'])->group(function () {

    Route::get('/studentviews', [StudentViewsController::class, 'index'])->name('studentviews.index');
   
});

Route::middleware(['auth:web'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware(['auth', 'verified']);
    Route::resource('students', StudentController::class)->middleware(['auth', 'verified']);
    Route::resource('subjects', SubjectController::class)->middleware(['auth', 'verified']);
    Route::resource('enrollments', EnrollmentController::class)->middleware(['auth', 'verified']);
    Route::get('/grades', [GradeController::class, 'index'])->name('grades.index')->middleware(['auth', 'verified']);
    Route::put('/grades/{enrollmentId}', [GradeController::class, 'update'])->name('grades.update')->middleware(['auth', 'verified']);
    Route::delete('/grades/{id}', [GradeController::class, 'destroy'])->name('grades.destroy')->middleware(['auth', 'verified']);
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout')->middleware(['auth', 'verified']);

});


require __DIR__.'/auth.php';
