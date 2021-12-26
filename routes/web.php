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
Route::get('/showExams', 'HomeController@showExams')->name('showExams');
Route::get('/showExamInfo/{examID}/{subjectID}', 'HomeController@showExamInfo')->name('showExamInfo');
Route::get('/showRegisteredExam', 'HomeController@showRegisteredExam')->name('showRegisteredExam');
Route::get('/showSuccessfullyExam', 'HomeController@showSuccessfullyExam')->name('showSuccessfullyExam');
Route::get('/showUnsuccessfullyExam', 'HomeController@showUnsuccessfullyExam')->name('showUnsuccessfullyExam');
Route::get('/storeResult/{examID}', 'HomeController@storeResult')->name('storeResult');
Route::get('/destroyResult/{resultID}/{subjectID}', 'HomeController@destroyResult')->name('destroyResult');

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

    Route::get('/showPrograms', 'EmployeeController@showPrograms')->name('employee.showPrograms');
    Route::get('/fetch_programs_data', 'EmployeeController@fetch_programs_data');
    Route::get('/createProgram', 'EmployeeController@createProgram')->name('employee.createProgram');
    Route::post('/storeProgram', 'EmployeeController@storeProgram')->name('employee.storeProgram');
    Route::get('/editProgram/{id}', 'EmployeeController@editProgram')->name('employee.editProgram');
    Route::post('/updateProgram/{id}', 'EmployeeController@updateProgram')->name('employee.updateProgram');
    Route::get('/destroyProgram/{id}', 'EmployeeController@destroyProgram')->name('employee.destroyProgram');

    Route::get('/showSubjects', 'EmployeeController@showSubjects')->name('employee.showSubjects');
    Route::get('/fetch_subjects_data', 'EmployeeController@fetch_subjects_data');
    Route::get('/createSubject', 'EmployeeController@createSubject')->name('employee.createSubject');
    Route::post('/storeSubject', 'EmployeeController@storeSubject')->name('employee.storeSubject');
    Route::get('/editSubject/{id}', 'EmployeeController@editSubject')->name('employee.editSubject');
    Route::post('/updateSubject/{id}', 'EmployeeController@updateSubject')->name('employee.updateSubject');
    Route::get('/destroySubject/{id}', 'EmployeeController@destroySubject')->name('employee.destroySubject');

    Route::get('/showUsers', 'EmployeeController@showUsers')->name('employee.showUsers');
    Route::get('/fetch_users_data', 'EmployeeController@fetch_users_data');
    Route::get('/createUser', 'EmployeeController@createUser')->name('employee.createUser');
    Route::post('/storeUser', 'EmployeeController@storeUser')->name('employee.storeUser');
    Route::get('/editUser/{id}', 'EmployeeController@editUser')->name('employee.editUser');
    Route::post('/updateUser/{id}', 'EmployeeController@updateUser')->name('employee.updateUser');
    Route::get('/destroyUser/{id}', 'EmployeeController@destroyUser')->name('employee.destroyUser');

    Route::get('/showSchedule', 'EmployeeController@showSchedule')->name('employee.showSchedule');
    Route::get('/createSchedule/{id}', 'EmployeeController@createSchedule')->name('employee.createSchedule');
    Route::post('/storeSchedule', 'EmployeeController@storeSchedule')->name('employee.storeSchedule');
    Route::post('/storeSchedule2', 'EmployeeController@storeSchedule2')->name('employee.storeSchedule2');
    Route::post('/storeSchedule3', 'EmployeeController@storeSchedule3')->name('employee.storeSchedule3');
    Route::post('/storeSchedule4', 'EmployeeController@storeSchedule4')->name('employee.storeSchedule4');
    Route::get('/destroySchedule/{scheduleID}/{programID}', 'EmployeeController@destroySchedule')->name('employee.destroySchedule');

    Route::get('/showExams', 'EmployeeController@showExams')->name('employee.showExams');
    Route::get('/createExam/{id}', 'EmployeeController@createExam')->name('employee.createExam');
    Route::post('/storeExam', 'EmployeeController@storeExam')->name('employee.storeExam');
    Route::post('/storeExam2', 'EmployeeController@storeExam2')->name('employee.storeExam2');
    Route::post('/storeExam3', 'EmployeeController@storeExam3')->name('employee.storeExam3');
    Route::post('/storeExam4', 'EmployeeController@storeExam4')->name('employee.storeExam4');
    Route::get('/updateExam/{examID}/{programID}', 'EmployeeController@updateExam')->name('employee.updateExam');

    Route::get('/showRegisteredExams', 'EmployeeController@showRegisteredExams')->name('employee.showRegisteredExams');
    Route::get('/showRegisteredExams2/{programID}', 'EmployeeController@showRegisteredExams2')->name('employee.showRegisteredExams2');
    Route::get('/showRegisteredExams2/{program_id}/fetch_registeredExams2_data', 'EmployeeController@fetch_registeredExams2_data');
    Route::post('/updateResult', 'EmployeeController@updateResult')->name('employee.updateResult');
    Route::get('/showPassedExams', 'EmployeeController@showPassedExams')->name('employee.showPassedExams');
    Route::post('/updateResult2', 'EmployeeController@updateResult2')->name('employee.updateResult2');
    Route::get('/fetch_passedExams_data', 'EmployeeController@fetch_passedExams_data');
    Route::get('/showUnsuccessfullyExams', 'EmployeeController@showUnsuccessfullyExams')->name('employee.showUnsuccessfullyExams');
    Route::get('/fetch_unsuccessfullyExams_data', 'EmployeeController@fetch_unsuccessfullyExams_data');
    Route::post('/updateResult3', 'EmployeeController@updateResult3')->name('employee.updateResult3');

    Route::get('/', 'EmployeeController@index')->name('employee.dashboard');
});
