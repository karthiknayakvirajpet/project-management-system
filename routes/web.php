<?php

use Illuminate\Support\Facades\Route;

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

//LoginController routes
Route::controller(App\Http\Controllers\Auth\LoginController::class)->group(function () 
{
    //registration form
    Route::get('/register', 'registerForm')->name('register.form');

    //register
    Route::post('/register', 'register')->name('register');

    //login form
    Route::get('/login', 'loginForm')->name('login.form');
    Route::get('/', 'loginForm');

    //login
    Route::post('/login', 'login')->name('login');

    //logout
    Route::any('/logout', 'logout')->name('logout');
});


//Common Routes to all Roles
Route::group(['middleware' => ['auth:sanctum', 'verified']], function()
{
    //DashboardController routes
    Route::controller(App\Http\Controllers\DashboardController::class)->group(function () 
    {
        //Dashboard
        Route::get('dashboard', 'index')->name('dashboard');
    });
});



//Project Manager Routes
Route::middleware(['auth', 'project_manager'])->group(function () 
{
    //ProjectController routes
    Route::controller(App\Http\Controllers\ProjectController::class)->group(function () 
    {
        Route::get('index-project', 'index')->name('project.index');
        Route::get('add-project', 'add')->name('project.add');
        Route::post('store-project', 'store')->name('project.store');
        Route::get('edit-project/{id}', 'edit')->name('project.edit');
        Route::post('update-project', 'update')->name('project.update');
        Route::get('delete-project/{id}', 'delete')->name('project.delete');
    });

    //TaskController routes
    Route::controller(App\Http\Controllers\TaskController::class)->group(function () 
    {
        Route::get('index-task', 'index')->name('task.index');
        Route::get('add-task', 'add')->name('task.add');
        Route::post('store-task', 'store')->name('task.store');
        Route::get('edit-task/{id}', 'edit')->name('task.edit');
        Route::post('update-task', 'update')->name('task.update');
        Route::get('delete-task/{id}', 'delete')->name('task.delete');

        //Get project team members
        Route::get('get-project-team-members/{project_id}', 'getProjectTeamMembers');
    });
});

//Team Member Routes
Route::middleware(['auth', 'team_member'])->group(function () 
{
    //TaskController routes
    Route::controller(App\Http\Controllers\TaskController::class)->group(function () 
    {
        Route::get('index-member-task', 'indexMemberTask')->name('member.task.index');
        Route::get('edit-member-task/{id}', 'editMemberTask')->name('member.task.edit');
        Route::post('update-member-task', 'updateMemberTask')->name('member.task.update');
    });
});