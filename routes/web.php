<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\NewsController;

Route::get('/', [RouteController::class, 'index'])->middleware('auth');
Route::get('/lessons', [RouteController::class, 'lessons'])->middleware('auth');
Route::get('/StudentTasks', [RouteController::class, 'StudentTasks'])->middleware('auth');
Route::get('/TeacherTasks', [RouteController::class, 'TeacherTasks'])->middleware('auth');
Route::get('/AdminClasses', [RouteController::class, 'AdminClasses'])->middleware('auth');
Route::get('/StudentMarks', [RouteController::class, 'StudentMarks'])->middleware('auth');


Route::get('/lessons/{date}', [ScheduleController::class, 'getLessonsByDate'])->name('lessons.by.date');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/create_user', [UserController::class, 'createUser'])->name('create-user');    

Route::post('/add_task', [TaskController::class, 'createTask'])->name('add.task');

Route::post('/create_lessons', 'AdminController@createLessons')->name('create.lessons');

Route::post('/upload-solution',  [TaskController::class, 'uploadSolutionFile'])->name('solution.upload');
Route::post('/upload-task/{lessonId}',  [TaskController::class, 'uploadTaskFile'])->name('task.upload');

Route::post('/download-task', [TaskController::class, 'downloadTaskFile'])->name('task.download');
Route::get('/download-solution/{StudentId}', [TaskController::class, 'downloadSolutionFile'])->name('solution.download');
Route::post('/mark/store', [MarkController::class, 'store'])->name('mark.store');
Route::post('/createNews', [AdminController::class, 'createNews'])->name('createNews');
Route::post('/createSubject', [AdminController::class, 'createSubjects'])->name('subjects.create');
Route::post('/createClass', [AdminController::class, 'createClass'])->name('class.create');




