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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'admin_guest', 'prefix' => 'admin'],
	function()
	{
		Route::get('/login', 'Admin\AuthController@getLogin')->name('admin.login');
		Route::post('/login', 'Admin\AuthController@login');
	});


Route::group(['middleware' => 'admin_authenticated', 'prefix' => 'admin'],
	function() {
		Route::get('/', function () { return view('admin.dashboard'); })->name('admin.dashboard');
		Route::get('/logout', 'Admin\AuthController@logout')->name('admin.logout');
		
		Route::get('/danh-muc/{type}', 'Admin\CategoryController@index')->name('admin.category');
		Route::get('/danh-muc/{type}/add', 'Admin\CategoryController@formAdd')->name('admin.category.add');
		Route::get('/danh-muc/{type}/{id}', 'Admin\CategoryController@formEdit')->name('admin.category.edit');
		Route::get('/danh-muc/{type}/{id}/active', 'Admin\CategoryController@active')->name('admin.category.active');
		Route::get('/danh-muc/{type}/{id}/deactive', 'Admin\CategoryController@deactive')->name('admin.category.deactive');
		Route::get('/danh-muc/{type}/{id}/delete', 'Admin\CategoryController@delete')->name('admin.category.delete');
		Route::post('/danh-muc/{type}/save', 'Admin\CategoryController@save')->name('admin.category.save');
		
		Route::get('/bds', 'Admin\BdsController@index')->name('admin.re');
		Route::post('/bds', 'Admin\BdsController@indexFilter');
		Route::get('/bds/tao-san-pham', 'Admin\BdsController@formAdd')->name('admin.re.add');
		Route::get('/bds/xoa-san-pham/{id_sp}', 'Admin\BdsController@delete')->name('admin.re.delete');
		Route::get('/bds/tao-ho-so/{id_sp}', 'Admin\BdsController@createHoSo')->name('admin.re.add.hoso');
		Route::get('/bds/xoa-ho-so/{id_sp}', 'Admin\BdsController@deleteHoSo')->name('admin.re.delete.hoso');
		Route::get('/bds/cap-nhat-ho-so/{id}', 'Admin\BdsController@formEdit')->name('admin.re.edit');
		Route::post('/bds/luu', 'Admin\BdsController@save')->name('admin.re.save');
		Route::post('/bds/upload/file/{id}', 'Admin\BdsController@uploadFile')->name('admin.re.upload.file');
		Route::post('/bds/xoa/file', 'Admin\BdsController@deleteFile')->name('admin.re.delete.file');
        
        Route::get('/tim-kiem/ho-so', 'Admin\SearchController@hoso')->name('admin.search.hoso');
        Route::post('/tim-kiem/ho-so', 'Admin\SearchController@hosoFilter');
        Route::get('/tim-kiem/quanh-day', 'Admin\SearchController@quanhday')->name('admin.search.quanhday');
        Route::post('/tim-kiem/quanh-day', 'Admin\SearchController@quanhdayResult');
        
        Route::get('/nguoi-dung', 'Admin\UsersController@index')->name('admin.users');
        Route::get('/nguoi-dung/tao-moi', 'Admin\UsersController@formAdd')->name('admin.users.add');
        Route::get('/nguoi-dung/edit/{id}', 'Admin\UsersController@formEdit')->name('admin.users.edit');
        /*Route::get('/nguoi-dung/{id}/phan-quyen', 'Admin\UsersController@formPermission')->name('admin.users.permission');*/
        Route::post('/nguoi-dung/luu', 'Admin\UsersController@save')->name('admin.users.save');
        Route::get('/nguoi-dung/danh-sach-nhom', 'Admin\UsersController@groups')->name('admin.users.groups');
	});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
