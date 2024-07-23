<?php

use App\Controllers\AdminController;
use App\Controllers\CategoryController;
use App\Controllers\LoginController;
use App\Controllers\ReviewController;
use App\Kernel\Router\Route;
use App\Controllers\HomeController;
use App\Controllers\MovieController;
use App\Controllers\RegisterController;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

return [
    Route::get("/", [HomeController::class, 'index']),
    Route::get("/home", [HomeController::class, 'index']),
    Route::get('/register', [RegisterController::class, 'index'], [GuestMiddleware::class]),
    Route::post('/register', [RegisterController::class, 'register'], [GuestMiddleware::class]),
    Route::get('/login', [LoginController::class, 'index'], [GuestMiddleware::class]),
    Route::post('/login', [LoginController::class, 'login'], [GuestMiddleware::class]),
    Route::post('/logout', [LoginController::class, 'logout']),
    Route::get('/admin', [AdminController::class, 'index']),
    Route::get('/admin/categories/add', [CategoryController::class, 'create']),
    Route::post('/admin/categories/add', [CategoryController::class, 'store']),
    Route::post('/admin/categories/destroy', [CategoryController::class, 'destroy']),
    Route::get('/admin/categories/update', [CategoryController::class, 'edit']),
    Route::post('/admin/categories/update', [CategoryController::class, 'update']),
    Route::get('/admin/movies/add', [MovieController::class, 'add'], [AuthMiddleware::class]),
    Route::post('/admin/movies/add', [MovieController::class, 'store'], [AuthMiddleware::class]),
    Route::post('/admin/movies/destroy', [MovieController::class, 'destroy']),
    Route::get('/admin/movies/update', [MovieController::class, 'edit']),
    Route::post('/admin/movies/update', [MovieController::class, 'update']),
    Route::get('/movie', [MovieController::class, 'show']),
    Route::post('/reviews/add', [ReviewController::class, 'store']),
    Route::get('/categories', [CategoryController::class, 'index']),
];