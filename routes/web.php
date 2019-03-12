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
    return redirect('/login');
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::resource('contacts', 'ContactsController');

Route::get('/admin', function() { 
    return redirect('/admin/login');
});
Route::get('/admin/login', 'AdminController@login')->name('admin_login');
Route::post('/admin/login', 'AdminController@login_process')->name('admin_login_process');
Route::get('/admin/logout', 'AdminController@logout')->name('admin_logout');

Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin_dashboard')->middleware('isAdmin');
Route::get('/admin/users', 'AdminController@users')->name('admin_users')->middleware('isAdmin');
Route::get('/admin/users/activate/{user_id}', 'AdminController@activate')->name('admin_users_activate')->middleware('isAdmin');
Route::get('/admin/users/deactivate/{user_id}', 'AdminController@deactivate')->name('admin_users_deactivate')->middleware('isAdmin');
