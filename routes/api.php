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
        Route::get('/me', 'me')->middleware('auth:sanctum');
    });

Route::prefix('/course')
    ->controller(CourseController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store')->middleware('auth:sanctum');
        Route::get('/{course}', 'show');
        Route::put('/{course}', 'update')->middleware('auth:sanctum');
        Route::delete('/{course}', 'destroy')->middleware('auth:sanctum');
    });

Route::prefix('/area')
    ->controller(AreaController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store')->middleware('auth:sanctum');
        Route::get('/{area}', 'show');
        Route::put('/{area}', 'update')->middleware('auth:sanctum');
        Route::delete('/{area}', 'destroy')->middleware('auth:sanctum');
    });

Route::prefix('/classroom')
    ->controller(ClassroomController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store')->middleware('auth:sanctum');
        Route::get('/{classroom}', 'show');
        Route::put('/{classroom}', 'update')->middleware('auth:sanctum');
        Route::delete('/{classroom}', 'destroy')->middleware('auth:sanctum');
    });

Route::prefix('/group')
    ->controller(GroupController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store')->middleware('auth:sanctum');
        Route::get('/{group}', 'show');
        Route::get('/next-groups/{course}', 'getNextGroupsByCourseId');
        Route::put('/{group}', 'update')->middleware('auth:sanctum');
        Route::delete('/{group}', 'destroy')->middleware('auth:sanctum');
        Route::patch('/{group}/status', 'changeStudentStatus')->middleware('auth:sanctum');
    });

Route::prefix('/student')
    ->controller(StudentController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store')->middleware('auth:sanctum');
        Route::get('/{student}', 'show');
        Route::get('/{cpf}/verify', 'verifyByCpf');
        Route::put('/{student}', 'update')->middleware('auth:sanctum');
        Route::delete('/{student}', 'destroy')->middleware('auth:sanctum');
    });

Route::prefix('/user')
    ->controller(UserController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store')->middleware('auth:sanctum');
        Route::get('/{user}', 'show');
        Route::put('/{user}', 'update')->middleware('auth:sanctum');
        Route::delete('/{user}', 'destroy')->middleware('auth:sanctum');
    });
