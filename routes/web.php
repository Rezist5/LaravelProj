<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TaskContoller;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ScheduleController;

Route::get('/', [RouteController::class, 'index'])->middleware('auth');
Route::get('/lessons', [RouteController::class, 'showLessons'])->middleware('auth');

Route::get('/lessons/{date}', [ScheduleController::class, 'getLessonsByDate'])->name('lessons.by.date');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/create_user', [UserController::class, 'createUser'])->name('create-user');

Route::post('/tasks/create', [TaskController::class, 'createTask'])->name('create.task');
Route::post('/tasks/upload', [TaskController::class, 'uploadSolution'])->name('upload.solution');
Route::post('/tasks/download', [TaskController::class, 'downloadSolution'])->name('download.solution');

Route::get('/getLessonsByDate/{date}', [ScheduleController::class, 'getLessonsByDate']);
