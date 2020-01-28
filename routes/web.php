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
Route::get('/demo-chk', function () {
    return view('employee.roledemo');
});
Route::get('/roles', function () {
    return view('employee.role');
});
Route::get('/permissions', function () {
    return view('employee.permission');
});
Route::get('/employees', function () {
    return view('employee.employee');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'ceo','middleware' => ['auth']], function() {
    //Role
    Route::resource('roles','RoleController');
    Route::get('roles-details','RoleController@details')->name('roles.details');
    Route::post('roles-update','RoleController@roleUpdate')->name('roles.roleupdate');
    Route::get('roles-delete','RoleController@roleDelete')->name('roles.delete');
    Route::resource('users','UserController');
    Route::resource('products','ProductController');
    Route::resource('permisssion','PermissionController');
    //Permission
    Route::get('permission-details','PermissionController@details')->name('permisssion.showPermission');
    Route::post('permission-update','PermissionController@roleUpdate')->name('permisssion.permissionUpdate');

});

