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

use Illuminate\Http\Request;

/* * ********************
 * Public routes
 * ******************* */

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about', ['sidemenu'=>true]);
});

Route::get('/benefits-for-users', function () {
    return view('benefits-for-users', ['sidemenu'=>true]);
});

Route::get('/benefits-for-organisations', function () {
    return view('benefits-for-organisations', ['sidemenu'=>true]);
});

Route::get('/where-is-the-flexibility', function () {
    return view('where-is-the-flexibility', ['sidemenu'=>true]);
});

Route::get('/resources-for-organisations', function () {
    return view('resources-for-organisations', ['sidemenu'=>true]);
});


Route::get('/your-data-and-privacy', function () {
    return view('your-data-and-privacy', ['sidemenu'=>true]);
});

if (config('app.registration_enabled') == false) {
    Auth::routes(['register' => false]);
}
else {
    Auth::routes();
}

Route::get('/assessment/{assessmentId}/report', function (Request $request) {
    
    if (!$request->hasValidSignature()) {
        abort(401);
    }

    return App::call('App\Http\Controllers\AssessmentController@report', [Route::current()->assessmentId]);
    
})->name('assessmentReport');


/* * *********************************
 * Routes for authenticated users
 * ********************************* */

Route::middleware(['auth'])->group(function() {

    Route::resource('assessment', 'AssessmentController')->only(['index', 'edit']);
    Route::middleware(['isOrganisationAdministrator'])->get('organisation-administrator-dashboard', 'OrganisationAdministratorController@dashboard');
});

