<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/add-company','CompanyController@index')->name('company.index');
Route::post('/add-company','CompanyController@store')->name('company.store');
Route::get('/add-company/edit/{id}','CompanyController@edit')->name('company.edit');
Route::post('/add-company/edit/{id}','CompanyController@update')->name('company.update');
Route::get('/add-company/delete/{id}','CompanyController@destroy')->name('company.delete');


Route::get('/add-employee','EmployeeController@index')->name('employee.index');
Route::post('/add-employee','EmployeeController@store')->name('employee.store');
Route::get('/add-employee/edit/{id}','EmployeeController@edit')->name('employee.edit');
Route::post('/add-employee/edit/{id}','EmployeeController@update')->name('employee.update');
Route::get('/add-employee/delete/{id}','EmployeeController@destroy')->name('employee.delete');

