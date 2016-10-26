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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/resume', function () {
    return view('resume');
});

/*
Route::get('/pdf', function () {
    return PDF::loadFile('http://www.getkyr.com')->inline('getkyr-'.time().'.pdf');
});
*/

Route::controllers([
    'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'common'], function()
{
   Route::group(['namespace' => 'Common'], function(){

        Route::post('rest/api/login', array('as' => 'common.login', 'uses' => 'CommonController@Login'));
        Route::post('rest/api/forgotlogin', array('as' => 'common.forgotlogin', 'uses' => 'CommonController@ForgotLogin'));

        Route::get('rest/api/listgroups', array('as' => 'common.listgroups', 'uses' => 'CommonController@getListGroups'));
        Route::get('rest/api/listentities', array('as' => 'common.listentities', 'uses' => 'CommonController@getListEntities'));
        Route::get('rest/api/{groupId}/listentities', array('as' => 'common.listentitiesbygroupid', 'uses' => 'CommonController@getListEntityByGroupId'));
        Route::get('pdf', array('as' => 'common.generatepdf', 'uses' => 'CommonController@generatePDF'));
        Route::get('excel', array('as' => 'common.importexcel', 'uses' => 'CommonController@importEXCEL'));
   });
});

Route::group(['prefix' => 'company'], function()
{
    Route::group(['namespace' => 'Company'], function(){

        Route::post('rest/api/login', array('as' => 'company.login', 'uses' => 'CompanyController@CompanyLogin'));
        Route::post('rest/api/forgotlogin', array('as' => 'company.forgotlogin', 'uses' => 'CompanyController@CompanyForgotLogin'));

        Route::get('rest/api/companies', array('as' => 'company.companies', 'uses' => 'CompanyController@getCompanyList'));
        Route::get('rest/api/{companyId}/details', array('as' => 'company.companydetails', 'uses' => 'CompanyController@getCompanyDetails'));
        Route::post('rest/api/profile', array('as' => 'company.saveprofile', 'uses' => 'CompanyController@saveCompanyProfile'));
        Route::put('rest/api/profile', array('as' => 'company.editprofile', 'uses' => 'CompanyController@saveCompanyProfile'));
        Route::delete('rest/api/company', array('as' => 'company.deletecompany', 'uses' => 'CompanyController@deleteCompany'));

        Route::get('rest/api/jobs', array('as' => 'company.jobs', 'uses' => 'JobController@getJobList'));
        Route::get('rest/api/jobs/{jobId}/details', array('as' => 'company.jobdetails', 'uses' => 'JobController@getJobDetails'));
        Route::post('rest/api/jobprofile', array('as' => 'company.jobprofile', 'uses' => 'JobController@saveJobProfile'));
        Route::put('rest/api/jobprofile', array('as' => 'company.jobprofile', 'uses' => 'JobController@saveJobProfile'));
        Route::delete('rest/api/job', array('as' => 'company.deletejob', 'uses' => 'JobController@deleteJob'));
    });
});

Route::group(['prefix' => 'candidate'], function()
{
    Route::group(['namespace' => 'Candidate'], function(){

        Route::post('rest/api/login', array('as' => 'candidate.login', 'uses' => 'CandidateController@CandidateLogin'));
        Route::post('rest/api/forgotlogin', array('as' => 'candidate.forgotlogin', 'uses' => 'CandidateController@CandidateForgotLogin'));

        Route::get('rest/api/candidates', array('as' => 'candidate.candidates', 'uses' => 'CandidateController@getCandidates'));
        Route::get('rest/api/{candidateId}/details', array('as' => 'candidate.candidatedetails', 'uses' => 'CandidateController@getCandidateDetails'));
        Route::post('rest/api/profile', array('as' => 'candidate.saveprofile', 'uses' => 'CandidateController@saveCandidateProfile'));
        Route::put('rest/api/profile', array('as' => 'candidate.saveprofile', 'uses' => 'CandidateController@saveCandidateProfile'));
        Route::delete('rest/api/profile', array('as' => 'candidate.deletecandidate', 'uses' => 'CandidateController@deleteCandidate'));

        Route::get('rest/api/{candidateId}/skills', array('as' => 'candidate.skills', 'uses' => 'CandidateController@getCandidateSkills'));
        Route::get('rest/api/{candidateId}/employment', array('as' => 'candidate.employment', 'uses' => 'CandidateController@getCandidateEmployment'));
        Route::get('rest/api/{candidateId}/projects', array('as' => 'candidate.projects', 'uses' => 'CandidateController@getCandidateProjects'));
        Route::get('rest/api/{candidateId}/preferences', array('as' => 'candidate.preferences', 'uses' => 'CandidateController@getCandidatePreferences'));

        Route::post('rest/api/skills', array('as' => 'candidate.saveskills', 'uses' => 'CandidateController@saveCandidateSkills'));
        Route::post('rest/api/employment', array('as' => 'candidate.saveemployment', 'uses' => 'CandidateController@saveCandidateEmployment'));
        Route::put('rest/api/employment', array('as' => 'candidate.editemployment', 'uses' => 'CandidateController@saveCandidateEmployment'));
        Route::post('rest/api/projects', array('as' => 'candidate.saveprojects', 'uses' => 'CandidateController@saveCandidateProjects'));
        Route::put('rest/api/projects', array('as' => 'candidate.editprojects', 'uses' => 'CandidateController@saveCandidateProjects'));

        Route::post('rest/api/preferences', array('as' => 'candidate.savepreferences', 'uses' => 'CandidateController@saveCandidatePreferences'));
        Route::put('rest/api/preferences', array('as' => 'candidate.editpreferences', 'uses' => 'CandidateController@saveCandidatePreferences'));
        /*Route::get('rest/api/{companyId}/details', array('as' => 'company.companydetails', 'uses' => 'CompanyController@getCompanyDetails'));
        Route::get('rest/api/jobs', array('as' => 'company.jobs', 'uses' => 'JobController@getJobList'));
        Route::get('rest/api/jobs/{jobId}/details', array('as' => 'company.jobdetails', 'uses' => 'JobController@getJobDetails'));*/



    });
});


