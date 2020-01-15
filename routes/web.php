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

Auth::routes();
//Voyager 
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// pages
Route::get('/', 'LandingPageController@index')->name('landing-page');
Route::get('/about', 'LandingPageController@about')->name('about');
Route::get('/service', 'LandingPageController@service')->name('service');
Route::get('/terms', 'LandingPageController@terms')->name('terms');
Route::get('/privacy', 'LandingPageController@privacy')->name('privacy');
Route::get('/service-detail', 'LandingPageController@serviceDetail')->name('service-detail');
Route::get('/service-discovery-detail', 'LandingPageController@serviceDetailDiscovery')->name('service-discovery-detail');
Route::post('/subscriber-store', 'LandingPageController@subscriberStore')->name('subscriber.store');
Route::get('/contact-us', 'LandingPageController@contactShow')->name('contactUs');
Route::post('/contact-us', 'LandingPageController@contactStore')->name('contactus.store');

//Resources
Route::name('resource.')->prefix('resource')->group(function() {
    Route::get('/', 'ResourceController@index')->name('index');
    Route::get('/articles', 'ResourceController@articles')->name('articles');
    Route::get('/case-study', 'ResourceController@caseStudy')->name('case-study');
    Route::get('/articles/{post}/', 'ResourceController@articlesDetail')->name('article-detail');
    Route::get('/case-study/{post}/', 'ResourceController@caseStudyDetail')->name('case-study-detail');
});

// Find Clinical Trial
Route::group(['middleware' => ['auth']], function () {
    Route::resource('clinicaltrial', 'ClinicalTrialController');
});

//Regestration Module

Route::name('profile.')->prefix('profile')->middleware(['auth'])->group(function () {
    Route::get('create', 'ProfilesController@create')->name('create');
    Route::get('skip', 'ProfilesController@skip')->name('skip');
});

Route::get('verify-email', 'Auth\VerificationController@index')->name('verify-email');
Route::get('send-email', 'Auth\VerificationController@sendEmail')->name('send-email');
Route::get('verify-email/{token}', 'Auth\VerificationController@verifyEmail')->name('verify');
Route::get('invoice', 'PaymentController@invoice')->name('invoice');
Route::get('invoicedetail/{id}', 'PaymentController@invoiceDetail')->name('invoicedetail');
Route::get('charge/{id}', 'PaymentController@charge')->name('charge');
Route::get('charge-visit/{id}/{clinicalid}', 'PaymentController@chargeVisit')->name('charge-visit');
Route::post('add-principal-customer/{id}', 'PaymentController@addPrincipalCustomer')->name('add-principal-customer');
Route::post('add-principal-card/{id}', 'PaymentController@addPrincipalCard')->name('add-principal-card');
Route::post('subscribe', 'PaymentController@subscribe')->name('subscribe');
Route::post('add-card', 'PaymentController@addCard')->name('add-card');
Route::post('add-customer', 'PaymentController@addCustomer')->name('add-customer');
Route::get('charge-applicant/{id}/{clinicalid}', 'PaymentController@chargeApplicant')->name('charge-applicant');

// Account
Route::name('account.')->prefix('account')->middleware(['auth'])->group(function () {
//    Listing Pages
    Route::get('index', 'AccountController@dashboardaccount')->name('index');
    Route::get('ajax-clinical', 'AccountController@dashboardaccountAjax')->name('ajax');
    Route::get('sub-investigator', 'AccountController@subinvestigator')->name('subinvestigator');
    Route::get('ajax-sub', 'AccountController@subinvestigatorAjax')->name('ajax-sub');
    Route::get('saved', 'AccountController@saved')->name('saved');
    Route::get('ajax-saved', 'AccountController@savedAjax')->name('ajax-saved');
    Route::get('trial/{id}', 'AccountController@showTrial')->name('view-trial');
    Route::get('investigator/{id}', 'AccountController@showSubTrial')->name('view-sub-trial');
    Route::get('saved/{id}', 'AccountController@showSavedTrial')->name('view-saved-trial');

//  Charity
    Route::name('charity.')->prefix('charity')->group(function () {
        Route::get('index', 'AccountController@indexCharity')->name('index');
        Route::get('ajax', 'AccountController@indexCharityAjax')->name('ajax');
        Route::get('create', 'AccountController@createCharity')->name('create');
        Route::post('create', 'AccountController@storeCharity')->name('store');
        Route::get('edit/{id}', 'AccountController@editCharity')->name('edit');
        Route::patch('edit/{id}', 'AccountController@updateCharity')->name('update');
        Route::delete('delete/{id}', 'AccountController@destroyCharity')->name('delete');
    });
//  Bank
    Route::name('bank.')->prefix('bank')->group(function () {
        Route::get('index', 'AccountController@indexBank')->name('index');
        Route::get('ajax', 'AccountController@indexBankAjax')->name('ajax');
        Route::get('create', 'AccountController@createBank')->name('create');
        Route::post('create', 'AccountController@storeBank')->name('store');
        Route::get('edit/{id}', 'AccountController@editBank')->name('edit');
        Route::patch('edit/{id}', 'AccountController@updateBank')->name('update');
        Route::delete('delete/{id}', 'AccountController@destroyBank')->name('delete');
    });
//  Bank
    Route::name('payment.')->prefix('payment')->group(function () {
        Route::get('index', 'AccountController@indexPayment')->name('index');
        Route::get('ajax', 'AccountController@indexPaymentAjax')->name('ajax');
        Route::get('create', 'AccountController@createPayment')->name('create');
        Route::post('create', 'AccountController@storePayment')->name('store');
        Route::get('edit/{id}', 'AccountController@editPayment')->name('edit');
        Route::patch('edit/{id}', 'AccountController@updatePayment')->name('update');
        Route::delete('delete/{id}', 'AccountController@destroyPayment')->name('delete');
        Route::get('add-principal/{id}', 'AccountController@addPrincipalPayment')->name('add-principal');
        // Route::get('index-principal/{id}', 'AccountController@indexPrincipalPayment')->name('index-principal');
    });
    // personal
    Route::name('personal.')->prefix('personal')->group(function () {
        Route::get('index', 'AccountController@indexPersonal')->name('index');
        Route::get('edit', 'AccountController@editPersonal')->name('edit');
        Route::patch('edit', 'AccountController@updatePersonal')->name('update');
        Route::post('upload', 'AccountController@imageup')->name('upload');
    });
    // Professional
    Route::name('professional.')->prefix('professional')->group(function () {
        Route::get('index', 'AccountController@indexProfessional')->name('index');
        Route::get('edit', 'AccountController@editProfessional')->name('edit');
        Route::patch('edit', 'AccountController@updateProfessional')->name('update');
        Route::post('upload-principal', 'AccountController@uploadPrincipal')->name('upload-principal');
        Route::post('upload-physician', 'AccountController@uploadPhysician')->name('upload-physician');
    });
    // patient
    Route::name('patient.')->prefix('patient')->group(function () {
        Route::get('index', 'AccountController@indexPatient')->name('index');
        Route::get('edit', 'AccountController@editPatient')->name('edit');
        Route::patch('edit', 'AccountController@updatePatient')->name('update');
    });

    Route::get('transaction-history/{status}', 'PaymentController@transactionHistory')->name('transaction-history');
    Route::get('transaction-detail/{id}', 'PaymentController@transactionDetail')->name('transaction-detail');
    Route::get('transactions-pdf', 'PaymentController@export_pdf')->name('transactions-pdf');
    ;
});

// Clinical Trial
Route::name('clinicalTrial.')->prefix('clinical-trial')->middleware(['auth'])->group(function () {
    Route::get('index', 'ClinicalTrialController@indexClinical')->name('index');
    Route::get('ajax', 'ClinicalTrialController@indexClinicalAjax')->name('ajax');
    Route::get('view/{id}', 'ClinicalTrialController@view')->name('view');
    Route::get('apply/{id}', 'ClinicalTrialController@apply')->name('apply');
    Route::post('apply/clinical/{id}', 'ClinicalTrialController@applied')->name('applied');
    Route::post('image/delete', 'ClinicalTrialController@fileDestroy')->name('image-delete');
    Route::post('upload', 'ClinicalTrialController@imageup')->name('upload');
    Route::get('saved/clinical/{id}', 'ClinicalTrialController@saved')->name('saved');
    Route::get('sub-investigator/{id}', 'ClinicalTrialController@applySubInvestigator')->name('apply-sub-investigator');
    Route::post('sub-investigator/{id}', 'ClinicalTrialController@appliedSubInvestigator')->name('applied-sub-investigator');
    Route::get('trial-info/{id}', 'ClinicalTrialController@trialInfo')->name('trail-info');
});

// Clinical Trial Management
Route::name('clinicalTrialManage.')->prefix('clinical-trial-manage')->middleware(['auth'])->group(function () {
    Route::get('create-irb', 'ClinicalManageController@createIrb')->name('create-irb');
    Route::post('upload-irb', 'ClinicalManageController@uploadIrb')->name('upload-irb');
    Route::get('autocomplete', 'ClinicalManageController@autocomplete')->name('autocomplete');
    Route::post('create-irb', 'ClinicalManageController@storeIrb')->name('store-irb');
    Route::get('create-non-irb', 'ClinicalManageController@createNonIrb')->name('create-non-irb');
    Route::post('create-non-irb', 'ClinicalManageController@storeNonIrb')->name('store-non-irb');
    Route::get('review/{status}', 'ClinicalManageController@review')->name('review');
    Route::get('clinical/{id}', 'ClinicalManageController@showClinical')->name('review-trial');
    Route::post('clinical/{id}', 'ClinicalManageController@updateClinical')->name('review-update');
    Route::get('clinical-trial', 'ClinicalManageController@indexClinicalApplications')->name('clinical-trial');
    Route::get('ajax', 'ClinicalManageController@indexClinicalApplicationsAjax')->name('ajax');
    Route::get('trial/{id}', 'ClinicalManageController@showTrial')->name('view-trial');
    Route::post('trial/{id}', 'ClinicalManageController@updateTrial')->name('view-update');
    Route::get('declined-trials', 'ClinicalManageController@declinedTrials')->name('declined-trials');
    Route::get('approved-trials', 'ClinicalManageController@approvedTrials')->name('approved-trials');
    Route::get('pending-trials', 'ClinicalManageController@pendingTrials')->name('pending-trials');
    Route::get('investigator', 'ClinicalManageController@indexInvestigatorApplications')->name('investigator');
    Route::get('sub-ajax', 'ClinicalManageController@indexInvestigatorApplicationsAjax')->name('investigator-ajax');
    Route::get('investigator/{id}', 'ClinicalManageController@viewSubTrial')->name('view-investigator');
    Route::post('investigator/{id}', 'ClinicalManageController@updateSubTrial')->name('update-investigator');
    Route::get('investigator-detail/{id}', 'ClinicalManageController@investigatorDetail')->name('investigator-detail');
    Route::get('manage', 'ClinicalManageController@manageTrials')->name('manage');
    Route::get('manage-ajax', 'ClinicalManageController@manageTrialsAjax')->name('manage-ajax');
    Route::get('view/{id}', 'ClinicalManageController@viewTrial')->name('view');
    Route::get('enroll/{id}', 'ClinicalManageController@enroll')->name('enroll');
    Route::get('applicant-list/{id}', 'ClinicalManageController@listApplicants')->name('applicant-list');
    Route::get('applicant-detail/{id}', 'ClinicalManageController@ApplicantDetail')->name('applicant-detail');
    Route::post('store-applicant', 'ClinicalManageController@storeApplicant')->name('store-applicant');
    Route::get('edit-applicant/{id}', 'ClinicalManageController@editApplicant')->name('edit-applicant');
    Route::get('review-applicants/{status}', 'ClinicalManageController@reviewApplicants')->name('review-applicants');
    Route::get('review-applicants-ajax/{status}', 'ClinicalManageController@reviewApplicantsAjax')->name('review-applicants-ajax');
    Route::get('participant-detail/{id}', 'ClinicalManageController@participantDetail')->name('participant-detail');
    Route::get('review-applicant/{id}', 'ClinicalManageController@reviewApplicant')->name('review-applicant');
    Route::post('review-applicant/{id}', 'ClinicalManageController@updateApplicant')->name('applicant-update');
    Route::get('download-pdf/{id}', 'ClinicalManageController@downloadPDF')->name('download-pdf');
});
Route::get('/find/clinicaltrials', 'ClinicalManageController@findtrials')->name('dashboard.findtrials');
Route::post('/save/clinical/{id}', 'ClinicalManageController@savetrial')->name('dashboard.savetrial');

// Clinical Retention Management
Route::name('clinicalTrialRetention.')->prefix('clinical-trial-retention')->middleware(['auth'])->group(function () {
    Route::get('enrolled', 'ClinicalRetentionController@enrolled')->name('enrolled');
    Route::get('enrolled-ajax', 'ClinicalRetentionController@enrolledAjax')->name('enrolled-ajax');
    Route::get('trial-detail/{id}', 'ClinicalRetentionController@trailDetail')->name('trial-detail');


    Route::get('research-site/{id}', 'ClinicalRetentionController@researchSite')->name('research-site');
    Route::get('research-site-info/{id}', 'ClinicalRetentionController@researchSiteInfo')->name('research-site-info');
    Route::delete('research-site-delete/{id}', 'ClinicalRetentionController@deleteSite')->name('research-site-delete');
    Route::post('research-site/{id}', 'ClinicalRetentionController@storeResearchSite')->name('store-research-sites');
    Route::post('patinet-research-site/{id}', 'ClinicalRetentionController@patinetResearchSite')->name('patinet-research-site');
    Route::get('research-site-edit/{id}', 'ClinicalRetentionController@editResearchSite')->name('edit-research-sites');
    Route::patch('research-site/{id}', 'ClinicalRetentionController@updateResearchSite')->name('update-research-sites');


    Route::get('trial-visit-number/{id}', 'ClinicalRetentionController@trialVisitNumber')->name('trial-visit-number');
    Route::post('trial-visit-number/{id}', 'ClinicalRetentionController@storeTrialVisitNumber')->name('store-trial-visit-number');
    Route::get('trial-visit', 'ClinicalRetentionController@trialVisit')->name('trial-visit');
    Route::get('trial-visit-ajax', 'ClinicalRetentionController@trialVisitAjax')->name('trial-visit-ajax');
    Route::get('participant-info/{id}', 'ClinicalRetentionController@participantInfo')->name('participant-info');
    Route::get('participant-detail/{id}', 'ClinicalRetentionController@participantDetail')->name('participant-detail');
    Route::post('trial-visit-create', 'ClinicalRetentionController@trialVisitStore')->name('store-trial-visit');
    Route::get('trial-visit-create', 'ClinicalRetentionController@trialVisitCreate')->name('create-trial-visit');
    Route::get('trial-visit-edit/{id}', 'ClinicalRetentionController@trialVisitEdit')->name('edit-trial-visit');
    Route::patch('trial-visit-edit/{id}', 'ClinicalRetentionController@trialVisitUpdate')->name('update-trial-visit');
    Route::get('index', 'ClinicalRetentionController@indexRetention')->name('index');
    Route::get('ajax', 'ClinicalRetentionController@indexRetentionAjax')->name('ajax');
    Route::get('upcoming', 'ClinicalRetentionController@upcomingTrials')->name('upcoming');
    Route::get('upcoming/{id}', 'ClinicalRetentionController@showUpcoming')->name('upcoming-trial');
    Route::get('create/{id}', 'ClinicalRetentionController@createTrial')->name('create');
    Route::post('create/{id}', 'ClinicalRetentionController@storeTrial')->name('store');
    Route::get('view/{id}', 'ClinicalRetentionController@viewTrial')->name('view');
    Route::delete('delete/{id}', 'ClinicalRetentionController@deletePatient')->name('delete');
    Route::delete('delete/location/{id}', 'ClinicalRetentionController@deleteLocation')->name('delete-location');
    Route::get('patient-visit', 'ClinicalRetentionController@patientVisit')->name('patient-visit');
    Route::get('patient-visit-ajax', 'ClinicalRetentionController@patientVisitAjax')->name('patient-visit-ajax');
    Route::get('complete-visit-details/{id}', 'ClinicalRetentionController@completeVisits')->name('complete-visit-details');
    Route::get('scheduled-visit-details/{id}', 'ClinicalRetentionController@scheduledVisits')->name('scheduled-visit-details');
});

//Message Module
Route::name('message.')->prefix('message')->middleware(['auth'])->group(function() {
    Route::get('index', 'MessageController@inbox')->name('inbox');
    Route::get('unread', 'MessageController@unread')->name('unread');
    Route::get('trash', 'MessageController@trash')->name('trash');
    Route::get('view/{id}', 'MessageController@view')->name('view');
    Route::get('chat/{id}', 'MessageController@chat')->name('chat');
    Route::delete('destroy/{message}', 'MessageController@destroy')->name('delete');
    Route::post('create/{id}', 'MessageController@create')->name('create');
    Route::put('restore/{id}', 'MessageController@restore')->name('restore');
});


