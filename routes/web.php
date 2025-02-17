<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\GradeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('students', StudentController::class);


Route::resource('subjects', SubjectController::class);



Route::resource('enrollments', EnrollmentController::class);


Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
Route::put('/grades/{enrollmentId}', [GradeController::class, 'update'])->name('grades.update');
Route::delete('/grades/{id}', [GradeController::class, 'destroy'])->name('grades.destroy');


Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__.'/auth.php';
