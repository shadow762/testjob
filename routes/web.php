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

Route::get('/', ['as' => 'default', 'uses' => 'EmployeeController@index']);
Route::get('/employee/form/{id?}', ['as' => 'employee.form', 'uses' => 'EmployeeController@getForm']);
Route::post('/employee/save', ['as' => 'employee.save', 'uses' => 'EmployeeController@save']);
Route::post('/employee/get', ['as' => 'employee.get', 'uses' => 'EmployeeController@get']);
Route::post('/employee/delete', ['as' => 'employee.delete', 'uses' => 'EmployeeController@delete']);
