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

Route::get('/', 'WelcomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/faculty-department/{id}', 'HomeController@requestDepartment');
Route::get('/department-books/{id}', 'HomeController@requestBooks');
Route::get('/search-book', 'HomeController@searchBook');

Route::get('/users/{id}/editProfile', 'UsersController@editProfile')->name('edit-profile');
Route::get('/users/{id}/changePassword', 'UsersController@changePassword')->name('changePassword');
Route::put('/users/changePassword/{id}', 'UsersController@pwdChange')->name('pwdChange');


Route::resource('/book', 'BookController');
Route::get('/requestDepartment/{id}', 'BookController@requestDepartment');

Route::resource('/department', 'DepartmentController');
Route::resource('/faculty', 'FacultyController');
Route::resource('/users', 'UsersController');
Route::get('/user-template', 'UsersController@excelTemplate')->name('excelTemplate');
Route::get('/users/paginate', 'UsersController@paginateIndex')->name('paginateIndex');

Route::resource('/fetch-book', 'GetBookController');
Route::get('/get-book/{id}', 'GetBookController@getbook');
Route::get('/download-book/{id}', 'GetBookController@downloadBook')->name('download-book');
Route::get('/open-book/{id}', 'GetBookController@openBook')->name('open-book');
Route::resource('/book/review', 'ReviewsController');
Route::get('/book/comments/{book_id}', 'ReviewsController@comments')->name('comment');
