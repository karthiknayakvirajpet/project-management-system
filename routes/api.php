<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//LoginController routes
Route::controller(App\Http\Controllers\Auth\LoginController::class)->group(function () 
{
    //registration
    Route::post('/register', 'register');

    //login
    Route::post('/login', 'login');

});


//Project Manager Routes
Route::middleware(['auth:sanctum', 'project_manager'])->group(function () 
{

});

//Team Member Routes
Route::middleware(['auth:sanctum', 'team_member'])->group(function () 
{

});