<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::resource('assessment', 'AssessmentController')->except(['index', 'edit'])->middleware('auth:api');

Route::post('/organisation-user', 'OrganisationAdministratorController@createAddUser')->middleware('auth:api');
Route::delete('/organisation-user/{userId}', 'OrganisationAdministratorController@deleteUser')->middleware('auth:api');
Route::put('/organisation-user/{userId}', 'OrganisationAdministratorController@updateUser')->middleware('auth:api');

Route::put('/organisation/{organisationId}', 'OrganisationAdministratorController@update')->middleware('auth:api');
