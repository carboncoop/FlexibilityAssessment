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

Route::get('/more-about-the-project', function () {
    return view('more-about-the-project');
});

Route::get('/how-could-I-benefit-from-flexibility', function () {
    return view('how-could-I-benefit-from-flexibility');
});

Route::get('/how-could-my-organisation-benefit-from-flexibility', function () {
    return view('how-could-my-organisation-benefit-from-flexibility');
});

Route::get('/scotland-potential-flexibility-map', function () {
    return view('scotland-potential-flexibility-map');
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

