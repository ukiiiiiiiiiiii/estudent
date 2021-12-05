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

Route::get('employee/test', function () {
    $program = \App\Program::where('id', 2)->get();

    $program->information()->create([
        'grade' => '1',
        'text' => 'pickin dim',
    ]);

    dd($program->information);
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
    Route::get('/searchInformation', 'EmployeeController@searchInformation')->name('employee.searchInformation');
    Route::get('/createInformation', 'EmployeeController@createInformation')->name('employee.createInformation');
    Route::post('/storeInformation', 'EmployeeController@storeInformation')->name('employee.storeInformation');
    Route::get('/editInformation/{id}', 'EmployeeController@editInformation')->name('employee.editInformation');
    Route::post('/updateInformation/{id}', 'EmployeeController@updateInformation')->name('employee.updateInformation');
    Route::get('/destroyInformation/{id}', 'EmployeeController@destroyInformation')->name('employee.destroyInformation');
    Route::get('/showSubjects', 'EmployeeController@showSubjects')->name('employee.showSubjects');
    Route::get('/fetch_subjects_data', 'EmployeeController@fetch_subjects_data');
    Route::get('/createSubject', 'EmployeeController@createSubject')->name('employee.createSubject');
    Route::post('/storeSubject', 'EmployeeController@storeSubject')->name('employee.storeSubject');
    Route::get('/editSubject/{id}', 'EmployeeController@editSubject')->name('employee.editSubject');
    Route::post('/updateSubject/{id}', 'EmployeeController@updateSubject')->name('employee.updateSubject');
    Route::get('/destroySubject/{id}', 'EmployeeController@destroySubject')->name('employee.destroySubject');
    Route::get('/createProgram', 'EmployeeController@createProgram')->name('employee.createProgram');
    Route::get('/showPrograms', 'EmployeeController@showPrograms')->name('employee.showPrograms');
    Route::post('/storeProgram', 'EmployeeController@storeProgram')->name('employee.storeProgram');
    Route::get('/editProgram/{id}', 'EmployeeController@editProgram')->name('employee.editProgram');
    Route::post('/updateProgram/{id}', 'EmployeeController@updateProgram')->name('employee.updateProgram');
    Route::get('/destroyProgram/{id}', 'EmployeeController@destroyProgram')->name('employee.destroyProgram');
    Route::get('/fetch_programs_data', 'EmployeeController@fetch_programs_data');
    Route::get('/', 'EmployeeController@index')->name('employee.dashboard');
});
