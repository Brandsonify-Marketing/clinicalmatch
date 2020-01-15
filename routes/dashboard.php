<?php

/*
  |--------------------------------------------------------------------------
  | Dashboard Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web dashboard routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */


//extra
Route::get('/home', 'Auth\VerificationController@index')->name('home');

Route::get('login/{provider}', 'SocialController@redirect');
Route::get('login/{provider}/callback', 'SocialController@Callback');
Route::get('/submit', 'ProfilesController@submitprofile')->name('profiledata');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/create/profile', 'ProfilesController@create')->name('profile.create');
    Route::get('/profile/view', 'ProfilesController@view')->name('profile.view');
    Route::get('/profiles/view', 'ProfilesController@viewprofile')->name('profile.viewprofile');
    Route::post('/create/profile', 'ProfilesController@store')->name('profile.store');
    Route::get('/profiles/create-step2', 'ProfilesController@createstep2')->name('profile.step2');
    Route::post('/profiles/storestep', 'ProfilesController@storestep')->name('profile.stepstore');
    Route::get('profile/thanks', 'ProfilesController@thanks')->name('profile.thanks');
    Route::get('profile/changePassword','ProfilesController@showChangePasswordForm')->name('profile.change');
    Route::post('profile/changePassword','ProfilesController@changePassword')->name('profile.changePass');
    // Route::get('profile/removeimage','ProfilesController@removeImage')->name('profile.removeimage');
    // Clinical Trial Management
    Route::get('/create/trialsubmit', 'ClinicalManageController@trialindex')->name('dashboard.submittrial');
    Route::post('/create/trialsubmit', 'ClinicalManageController@trialstore')->name('dashboard.storetrial');
    Route::get('/create/nontrialsubmit', 'ClinicalManageController@nontrialindex')->name('dashboard.submittrialnonirb');
    Route::post('/create/nontrialsubmit', 'ClinicalManageController@nontrialstore')->name('dashboard.storetrialnonirb');

});
