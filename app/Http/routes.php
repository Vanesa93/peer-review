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
//Route::get('fileentry', 'FileEntryController@index');
//Route::get('fileentry/get/{filename}', [
//    'as' => 'getentry', 'uses' => 'FileEntryController@get']);
//Route::post('/addFileFromLecturer', [
//    'as' => 'addFileFromLecturer', 'uses' => 'FileEntryController@addFileFromLecturer']);

//registration validation
Route::get('/checkUsername', 'RegistrationController@checkExistingUseraname');
Route::get('/checkEmail', 'RegistrationController@checkExistingEmail');
Route::get('/checkFacNumbers', 'RegistrationController@checkExistingFacNumber');

//lecturer's courses
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
Route::get('users', 'UserController@getUsers');
Route::get('users/edit/{id}', 'UserController@edit');
Route::put('users/edit/{id}/updateUser', [
    'as' => 'updateUser', 'uses' => 'UserController@update']);
Route::delete('users/remove/{id}', 'UserController@destroy');

//groups 
Route::get('groups/create','GroupsController@create');
Route::get('groups','GroupsController@index');
Route::get('getGroupMajors','GroupsController@getGroupMajors');
Route::get('getUsersGroup','GroupsController@getUsersGroup');
Route::get('getUsersGroupWithYear','GroupsController@getUsersGroupWithYear');
Route::post('storeGroup','GroupsController@store');
Route::get('groups/edit/{id}', 'GroupsController@edit');
Route::put('groups/edit/{id}/updateGroup', [
    'as' => 'updateGroup', 'uses' => 'GroupsController@update']);
Route::get('groups/{id}/users', 'GroupsController@seeUsers');
Route::delete('groups/remove/{id}', 'GroupsController@destroy');
Route::get('getGroupMajorsForEdit','GroupsController@getGroupMajorsForEdit');
Route::get('getUsersGroupForEdit','GroupsController@getUsersGroupForEdit');

//faculties 
Route::get('faculties','FacultiesController@getFaculties');
Route::get('add/faculty','FacultiesController@addFaculty');
Route::post('storeFaculty','FacultiesController@storeFaculty');
Route::delete('faculty/remove/{id}', 'FacultiesController@removeFaculty');
Route::get('faculty/edit/{id}', 'FacultiesController@editFaculty');
Route::put('faculty/edit/{id}/updateFaculty', [
    'as' => 'updateFaculty', 'uses' => 'FacultiesController@updateFaculty']);

//majors
Route::get('majors/{id}','MajorsController@getMajors');
Route::get('add/major/{id}','MajorsController@addMajor');
Route::post('storeMajor','MajorsController@storeMajor');
Route::get('major/edit/{id}','MajorsController@editMajor');
Route::put('major/edit/{id}/updateMajor', [
    'as' => 'updateMajor', 'uses' => 'MajorsController@updateMajor']);
Route::delete('major/remove/{id}', 'MajorsController@removeMajor');
Route::get('getMajors','MajorsController@getMajorsForRegister');
Route::get('add/major','MajorsController@createMajorWithAllFaculties');

//tasks
Route::get('tasks','AssignmentController@index');
Route::get('task/{id}','AssignmentController@show');
Route::get('tasks/create','AssignmentController@create');
Route::post('storeTask','AssignmentController@store');
Route::get('getGroupsForCourse','AssignmentController@getGroupsForCourse');
Route::delete('tasks/remove/{id}', 'AssignmentController@destroy');
Route::get('tasks/{id}/students', 'AssignmentController@getAssignedToTaskUsers');
Route::get('tasks/{id}/edit','AssignmentController@edit');
Route::put('tasks/{id}/edit/update', [
    'as' => 'updateTask', 'uses' => 'AssignmentController@update']);
Route::get('tasks/{id}/helpmaterials', 'AssignmentController@getfilesForTask');
Route::get('file/{id}/{filename}/open', 'AssignmentController@openFilesForTask');
Route::get('tasks/{id}/upload', 'AssignmentController@uploadFileToTask');
Route::post('upload/{id}', 'AssignmentController@upload');
Route::delete('file/remove/{filename}', 'AssignmentController@deleteFileFromTask');
Route::get('tasks/solution/{id}/{filename}/open', 'AssignmentController@openUploadedSolution');
Route::post('storeGrade','AssignmentController@storeGrade');

//reviews
Route::get('reviews','LecturersReviewsController@index');
Route::get('reviews/create','LecturersReviewsController@create');
Route::post('storeLecturerReview', 'LecturersReviewsController@store');
Route::delete('reviews/remove/{id}','LecturersReviewsController@destroy');
Route::get('reviews/{id}/edit','LecturersReviewsController@edit');
Route::put('reviews/{id}/edit/update', [
    'as' => 'updateLecturerReview', 'uses' => 'LecturersReviewsController@update']);

//student's courses
Route::get('mycourses','StudentCoursesController@index');

//student's groups
Route::get('mygroups','StudentsGroupsController@index');

//student's tasks
Route::get('mytasks','StudentTaskController@index');
Route::get('mytasks/{id}/helpmaterials', 'StudentTaskController@getfilesForTask');
Route::get('mytasks/{id}/upload', 'StudentTaskController@uploadFileToTask');
Route::get('mytasks/{id}','StudentTaskController@show');
Route::post('upload/solution/{id}', 'StudentTaskController@upload');
Route::get('solution/{id}/{filename}/open', 'StudentTaskController@openSolution');
Route::get('mytasks/{id}/review', 'StudentTaskController@reviewToTask');
Route::get('questionary/{id}/{filename}/open', 'StudentTaskController@questionaryToTask');
Route::get('review/{id}/{filename}/open', 'StudentTaskController@reviewToTaskOpen');


//student's reviews
Route::get('myreviews','StudentsReviewsController@index');
Route::get('myreviews/questionary/{id}/{filename}/open', 'StudentsReviewsController@openQuestionary');
Route::get('myreviews/solutionreview/{id}/{filename}/open', 'StudentsReviewsController@openSolutionToReview');
Route::get('myreviews/upload/review/{id}', 'StudentsReviewsController@uploadReview');
Route::get('myreviews/writerreview/{id}/{filename}/open', 'StudentsReviewsController@openUploadedReview');
Route::post('myreviews/upload/review/solution/{id}', 'StudentsReviewsController@upload');


