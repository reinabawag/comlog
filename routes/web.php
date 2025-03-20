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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'ComputerController@index')->name('home');

// rein custom routes
Route::group(['middleware' => 'auth'], function() {
	Route::resource('computer', 'ComputerController');
	Route::get('license/type', 'LicenseController@get_license_by_type')->name('license.type');
	Route::resource('license', 'LicenseController');
	Route::get('software/create/{computerID}', 'SoftwareController@create')->name('software.create');
	Route::resource('software', 'SoftwareController');
	Route::get('hardware/add/{computer}', 'HardwareController@add_hardware')->name('hardware.add');
	Route::resource('hardware', 'HardwareController', ['except' => [
		'store'
	]]);
	Route::post('/hardware/store/{computer}', 'HardwareController@store')->name('hardware.store');
	Route::post('department/list', 'DepartmentController@getDepartments')->name('department.list');
	Route::resource('department', 'DepartmentController');
});

Route::get('/report', 'ReportController@index')->name('report.index');
Route::get('/report/hardware/{id}', 'ReportController@computerHardwareReport')->where(['id' => '[1-9]+'])->name('report.hardware');
Route::get('/getComputerHostnames', 'ReportController@getComputerHostnames');