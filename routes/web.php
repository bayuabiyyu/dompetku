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
    // return view('welcome');
    return view('welcome');
});


//AUTH ROUTES
Auth::routes();

//USER ROUTES
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/logout', 'Auth\LoginController@logoutUser')->name('user.logout');

//ADMIN ROUTES
Route::group(['prefix' => 'admin'], function(){
    Route::get('/login', 'AuthAdmin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'AuthAdmin\LoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.home');
    Route::get('/logout', 'AuthAdmin\LoginController@logoutAdmin')->name('admin.logout');

    // Master Route
    Route::get('/user/datatable', 'Admin\Master\UserController@dataTable')->name('user.datatable');
    Route::resource('/user', 'Admin\Master\UserController');

});

// //ADMIN ROUTE
// Route::get('/admin', function () {
//     return view('admin.dashboard');
// })->name('adminpage');
// Route::get('admin-login', 'Auth\AdminLoginController@showLoginForm');
// Route::post('admin-login', ['as' => 'admin-login', 'uses' => 'Auth\AdminLoginController@login']);
// Route::get('admin-register', 'Auth\AdminLoginController@showRegisterPage');
// Route::post('admin-register', 'Auth\AdminLoginController@register')->name('admin.register');
// //END ADMIN ROUTE
