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


//USER ROUTES
Route::group(['prefix' => 'user'], function(){
    //AUTH ROUTES
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/logout', 'Auth\LoginController@logoutUser')->name('user.logout');

// MASTER ROUTE
    // Kategori Route
    Route::post('/kategori/datatable', 'User\Master\KategoriController@dataTable')->name('kategori.datatable');
    Route::resource('/kategori', 'User\Master\KategoriController');

// EXPENSE ROUTE
    Route::get('/expense/{id?}/{date?}/edit', ['as' => 'expense.edits', 'uses' => 'User\Dompet\ExpenseController@edits']);
    Route::delete('/expense/{id?}/{date?}/destroy', ['as' => 'expense.destroys', 'uses' => 'User\Dompet\ExpenseController@destroys']);
    Route::put('/expense/{id?}/{date?}/update', ['as' => 'expense.updates', 'uses' => 'User\Dompet\ExpenseController@updates']);
    Route::post('/expense/datatable', 'User\Dompet\ExpenseController@dataTable')->name('expense.datatable');
    Route::resource('/expense', 'User\Dompet\ExpenseController');

// INCOME ROUTE
    Route::get('/income/{id?}/{date?}/edit', ['as' => 'income.edits', 'uses' => 'User\Dompet\IncomeController@edits']);
    Route::delete('/income/{id?}/{date?}/destroy', ['as' => 'income.destroys', 'uses' => 'User\Dompet\IncomeController@destroys']);
    Route::put('/income/{id?}/{date?}/update', ['as' => 'income.updates', 'uses' => 'User\Dompet\IncomeController@updates']);
    Route::post('/income/datatable', 'User\Dompet\IncomeController@dataTable')->name('income.datatable');
    Route::resource('/income', 'User\Dompet\IncomeController');

// PROFILE ROUTE
    Route::get('/profile/ubahpassword', 'User\Master\ProfileController@formUbahPassword')->name('profile.form_ubah_password');
    Route::post('/profile/actionubahpassword', 'User\Master\ProfileController@actionUbahPassword')->name('profile.action_ubah_password');
});

//ADMIN ROUTES
Route::group(['prefix' => 'admin'], function(){
    Route::get('/login', 'AuthAdmin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'AuthAdmin\LoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.home');
    Route::get('/logout', 'AuthAdmin\LoginController@logoutAdmin')->name('admin.logout');
// MASTER ROUTE
    // User Route
    Route::post('/user/datatable', 'Admin\Master\UserController@dataTable')->name('user.datatable');
    Route::resource('/user', 'Admin\Master\UserController');
    //Admin Route
    Route::post('/admin/datatable', 'Admin\Master\AdminController@dataTable')->name('admin.datatable');
    Route::resource('/admin', 'Admin\Master\AdminController');
// END MASTER ROUTE
});
