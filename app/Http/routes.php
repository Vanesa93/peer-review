<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
//language
Route::get('/language/{locale}', [
    'before' => 'csrf',
    'as' => 'language-chooser',
    'uses' => 'LanguageController@chooser']);

//files
Route::get('fileentry', 'FileEntryController@index');
Route::get('fileentry/get/{filename}', [
    'as' => 'getentry', 'uses' => 'FileEntryController@get']);
Route::post('/add', [
    'as' => 'addentry', 'uses' => 'FileEntryController@add']);

//registration validation
Route::get('/checkUsername', 'RegistrationController@checkExistingUseraname');
Route::get('/checkEmail', 'RegistrationController@checkExistingEmail');
Route::get('/checkFacNumbers', 'RegistrationController@checkExistingFacNumber');

//courses
Route::get('courses', 'CoursesController@index');
Route::get('courses/create', 'CoursesController@create');
Route::post('/storeCourse', 'CoursesController@store');
Route::get('courses/edit/{id}', 'CoursesController@edit');
Route::put('courses/edit/{id}/update', [
    'as' => 'updateCourse', 'uses' => 'CoursesController@update'
]);
Route::delete('courses/remove/{id}', 'CoursesController@destroy');

//users
Route::get('register', 'UserController@register');
Route::post('register/user', 'UserController@create');
//Route::post('register/userContinue', 'AdminController@addUser');
Route::get('users', 'AdminController@getUsers');
Route::get('users/edit/{id}', 'UserController@edit');
Route::put('users/edit/{id}/updateUser', [
    'as' => 'updateUser', 'uses' => 'UserController@update']);
Route::delete('users/remove/{id}', 'UserController@destroy');

//groups create- admin
Route::get('groups/create','GroupsController@create');
Route::get('groups','GroupsController@index');

//faculties and majors- admin
Route::get('faculties','AdminController@getFaculties');
Route::get('majors/{id}','AdminController@getMajors');
Route::get('add/faculty','AdminController@addFaculty');
Route::get('add/major','AdminController@addMajor');
Route::post('storeMajor','AdminController@storeMajor');

Route::post('storeFaculty','AdminController@storeFaculty');
Route::get('faculty/edit/{id}', 'AdminController@editFaculty');
Route::put('faculty/edit/{id}/updateFaculty', [
    'as' => 'updateFaculty', 'uses' => 'AdminController@updateFaculty']);
Route::get('major/edit/{id}','AdminController@editMajor');
Route::put('major/edit/{id}/updateMajor', [
    'as' => 'updateMajor', 'uses' => 'AdminController@updateMajor']);
Route::delete('faculty/remove/{id}', 'AdminController@removeFaculty');
Route::delete('major/remove/{id}', 'AdminController@removeMajor');