<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/createEmployee', 'AdminController@createEmployee')->name('admin.createEmployee');
    Route::post('/storeEmployee', 'AdminController@storeEmployee')->name('admin.storeEmployee');
    Route::get('/editEmployee/{id}', 'AdminController@editEmployee')->name('admin.editEmployee');
    Route::post('/updateEmployee/{id}', 'AdminController@updateEmployee')->name('admin.updateEmployee');
    Route::get('/destroyEmployee/{id}', 'AdminController@destroyEmployee')->name('admin.destroyEmployee');
    Route::get('/fetch_employees_data', 'AdminController@fetch_employees_data');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
});

Route::prefix('employee')->group(function() {
    Route::get('/login', 'Auth\EmployeeLoginController@showLoginForm')->name('employee.login');
    Route::post('/login', 'Auth\EmployeeLoginController@login')->name('employee.login.submit');
    Route::post('/logout', 'Auth\EmployeeLoginController@logout')->name('employee.logout');
    Route::get('/createProgram', 'EmployeeController@createProgram')->name('employee.createProgram');
    Route::get('/showPrograms', 'EmployeeController@showPrograms')->name('employee.showPrograms');
    Route::post('/storeProgram', 'EmployeeController@storeProgram')->name('employee.storeProgram');
    Route::get('/editProgram/{id}', 'EmployeeController@editProgram')->name('employee.editProgram');
    Route::post('/updateProgram/{id}', 'EmployeeController@updateProgram')->name('employee.updateProgram');
    Route::get('/destroyProgram/{id}', 'EmployeeController@destroyProgram')->name('employee.destroyProgram');
    Route::get('/fetch_programs_data', 'EmployeeController@fetch_programs_data');
    Route::get('/', 'EmployeeController@index')->name('employee.dashboard');
});
