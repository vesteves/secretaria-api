<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/health', function () {
    return response()->json([
        "msg" => "OK"
    ]);
});

Route::prefix('/auth')
    ->controller(UserController::class)
    ->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
        Route::get('/test', 'test')->middleware('auth:sanctum');
    });

Route::prefix('/course')
    ->controller(CourseController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{course}', 'show');
        Route::put('/{course}', 'update');
        Route::delete('/{course}', 'destroy');
    });

Route::prefix('/area')
    ->controller(AreaController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{area}', 'show');
        Route::put('/{area}', 'update');
        Route::delete('/{area}', 'destroy');
    });

Route::prefix('/classroom')
    ->controller(ClassroomController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{classroom}', 'show');
        Route::put('/{classroom}', 'update');
        Route::delete('/{classroom}', 'destroy');
    });

Route::prefix('/group')
    ->controller(GroupController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{group}', 'show');
        Route::get('/next-groups/{course}', 'getNextGroupsByCourseId');
        Route::put('/{group}', 'update');
        Route::delete('/{group}', 'destroy');
        Route::patch('/{group}/status', 'changeStudentStatus');
    });

Route::prefix('/student')
    ->controller(StudentController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{student}', 'show');
        Route::put('/{student}', 'update');
        Route::delete('/{student}', 'destroy');
    });
