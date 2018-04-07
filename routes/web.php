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
    return redirect()->route('home');
});

Auth::routes();

Route::get('register', function() {
	return abort(404);
});

Route::get('password/reset', function() {
	return abort(404);
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/mahasiswa', 'HomeController@jurusan')->name('jurusan');
Route::get('/mahasiswa/{jurusan}', 'Admin\JurusanController@show')->name('mahasiswa');
Route::get('/alumni', 'HomeController@alumni')->name('alumni');
Route::get('/alumni/job', 'HomeController@alumniJob')->name('alumni.job');
Route::get('beasiswa-info', 'HomeController@beasiswa')->name('beasiswa.info');
Route::get('/beasiswa-detail/{beasiswa}', 'Admin\BeasiswaController@show')->name('beasiswa.detail');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
	Route::get('/', 'HomeController@index')->name('admin.home');

	Route::get('mahasiswa/{jurusan}', 'JurusanController@show')->name('mahasiswa.jurusan');
	Route::get('alumni/all', 'AlumniController@alumniJurusan')->name('alumni.jurusan');

	Route::resource('mahasiswa', 'MahasiswaController');
	Route::resource('jurusan', 'JurusanController');
	Route::resource('beasiswa', 'BeasiswaController');
	Route::resource('alumni', 'AlumniController');
});
