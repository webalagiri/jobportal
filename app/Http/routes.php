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

Route::group(['prefix' => 'common'], function()
{
   Route::group(['namespace' => 'Common'], function(){
      Route::get('rest/api/listgroups', array('as' => 'common.listgroups', 'uses' => 'CommonController@getListGroups'));
      Route::get('rest/api/listentities', array('as' => 'common.listentities', 'uses' => 'CommonController@getListEntities'));
      Route::get('rest/api/{groupId}/listentities', array('as' => 'common.listentitiesbygroupid', 'uses' => 'CommonController@getListEntityByGroupId'));
   });
});

Route::group(['prefix' => 'company'], function()
{
    Route::group(['namespace' => 'Company'], function(){
        Route::get('rest/api/companies', array('as' => 'company.companies', 'uses' => 'CompanyController@getCompanyList'));
        Route::get('rest/api/{companyId}/details', array('as' => 'company.companydetails', 'uses' => 'CompanyController@getCompanyDetails'));
        Route::post('rest/api/profile', array('as' => 'company.saveprofile', 'uses' => 'CompanyController@saveCompanyProfile'));
        Route::delete('rest/api/company', array('as' => 'company.deletecompany', 'uses' => 'CompanyController@deleteCompany'));

        Route::get('rest/api/jobs', array('as' => 'company.jobs', 'uses' => 'JobController@getJobList'));
        Route::get('rest/api/jobs/{jobId}/details', array('as' => 'company.jobdetails', 'uses' => 'JobController@getJobDetails'));
        Route::post('rest/api/jobprofile', array('as' => 'company.jobprofile', 'uses' => 'JobController@saveJobProfile'));
        Route::delete('rest/api/job', array('as' => 'company.deletejob', 'uses' => 'JobController@deleteJob'));
    });
});

Route::group(['prefix' => 'candidate'], function()
{
    Route::group(['namespace' => 'Candidate'], function(){
        Route::get('rest/api/candidates', array('as' => 'candidate.candidates', 'uses' => 'CandidateController@getCandidates'));
        Route::get('rest/api/{candidateId}/details', array('as' => 'candidate.candidatedetails', 'uses' => 'CandidateController@getCandidateDetails'));
        Route::delete('rest/api/candidate', array('as' => 'candidate.deletecandidate', 'uses' => 'CandidateController@deleteCandidate'));
        /*Route::get('rest/api/{companyId}/details', array('as' => 'company.companydetails', 'uses' => 'CompanyController@getCompanyDetails'));
        Route::get('rest/api/jobs', array('as' => 'company.jobs', 'uses' => 'JobController@getJobList'));
        Route::get('rest/api/jobs/{jobId}/details', array('as' => 'company.jobdetails', 'uses' => 'JobController@getJobDetails'));*/
    });
});


