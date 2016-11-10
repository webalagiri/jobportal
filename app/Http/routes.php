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

       Route::group(['middleware' => 'jobportal.auth'], function () {
           Route::get('rest/api/listgroups', array('as' => 'common.listgroups', 'uses' => 'CommonController@getListGroups'));
       });


      Route::get('rest/api/listentities', array('as' => 'common.listentities', 'uses' => 'CommonController@getListEntities'));
      Route::get('rest/api/{groupId}/listentities', array('as' => 'common.listentitiesbygroupid', 'uses' => 'CommonController@getListEntityByGroupId'));
      Route::get('rest/api/cities', array('as' => 'common.cities', 'uses' => 'CommonController@getCities'));
      Route::get('rest/api/countries', array('as' => 'common.countries', 'uses' => 'CommonController@getCountries'));

      Route::post('rest/api/login', array('as' => 'common.login', 'uses' => 'CommonController@Login'));
      Route::post('rest/api/forgotlogin', array('as' => 'common.forgotlogin', 'uses' => 'CommonController@ForgotLogin'));
      Route::post('rest/api/changepassword', array('as' => 'common.changepassword', 'uses' => 'CommonController@ChangePassword'));
      Route::post('rest/api/logout', array('as' => 'common.login', 'uses' => 'CommonController@Logout'));

      //Route::get('rest/api/listgroups', array('as' => 'common.listgroups', 'uses' => 'CommonController@getListGroups'));
      Route::get('rest/api/listentities', array('as' => 'common.listentities', 'uses' => 'CommonController@getListEntities'));
      Route::get('rest/api/{groupId}/listentities', array('as' => 'common.listentitiesbygroupid', 'uses' => 'CommonController@getListEntityByGroupId'));

      Route::get('pdf', array('as' => 'common.generatepdf', 'uses' => 'CommonController@generatePDF'));
      Route::get('excel', array('as' => 'common.importexcel', 'uses' => 'CommonController@importEXCEL'));
      Route::get('download', array('as' => 'common.download', 'uses' => 'CommonController@downloadFile'));

   });
});

Route::group(['prefix' => 'api'], function(){
    Route::post('token', 'AuthenticateController@authenticateUser');
    /*Route::group(['middleware' => 'jwt-auth'], function () {
        Route::post('getuserdetails', 'AuthenticateController@getUserDetails');
    });*/
});

Route::group(['prefix' => 'company'], function()
{
    Route::group(['namespace' => 'Company'], function(){

        Route::post('rest/api/register', array('as' => 'company.register', 'uses' => 'CompanyController@CompanyRegister'));
        Route::post('rest/api/login', array('as' => 'company.login', 'uses' => 'CompanyController@CompanyLogin'));
        Route::post('rest/api/forgotlogin', array('as' => 'company.forgotlogin', 'uses' => 'CompanyController@CompanyForgotLogin'));
        //Route::post('rest/api/changelogin', array('as' => 'company.changelogin', 'uses' => 'CompanyController@CompanyForgotLogin'));

        //Route::get('rest/api/companies', array('as' => 'company.companies', 'uses' => 'CompanyController@getCompanyList'));
        Route::group(['middleware' => 'jobportal.auth'], function () {
            Route::get('rest/api/companies', array('as' => 'company.companies', 'uses' => 'CompanyController@getCompanyList'));
            Route::post('rest/api/profile', array('as' => 'company.saveprofile', 'uses' => 'CompanyController@saveCompanyProfile'));

            Route::post('rest/api/interviewlist', array('as' => 'company.interviewlist', 'uses' => 'CompanyController@getInterviewList'));
        });


        Route::get('rest/api/{companyId}/details', array('as' => 'company.companydetails', 'uses' => 'CompanyController@getCompanyDetails'));
        //Route::post('rest/api/profile', array('as' => 'company.saveprofile', 'uses' => 'CompanyController@saveCompanyProfile'));
        Route::put('rest/api/profile', array('as' => 'company.editprofile', 'uses' => 'CompanyController@saveCompanyProfile'));
        Route::delete('rest/api/company', array('as' => 'company.deletecompany', 'uses' => 'CompanyController@deleteCompany'));

        Route::get('rest/api/jobs', array('as' => 'company.jobs', 'uses' => 'JobController@getJobList'));
        Route::get('rest/api/jobs/{jobId}/details', array('as' => 'company.jobdetails', 'uses' => 'JobController@getJobDetails'));
        Route::post('rest/api/jobprofile', array('as' => 'company.jobprofile', 'uses' => 'JobController@saveJobProfile'));
        Route::put('rest/api/jobprofile', array('as' => 'company.jobprofile', 'uses' => 'JobController@saveJobProfile'));
        Route::delete('rest/api/job', array('as' => 'company.deletejob', 'uses' => 'JobController@deleteJob'));

        Route::get('rest/api/companycount', array('as' => 'company.companycount', 'uses' => 'CompanyController@getCompanyCount'));
        Route::get('rest/api/jobcount', array('as' => 'company.jobcount', 'uses' => 'JobController@getJobCount'));

        Route::get('rest/api/industries', array('as' => 'company.industries', 'uses' => 'CompanyController@getIndustries'));

        Route::get('rest/api/latestjobs', array('as' => 'company.latestjobs', 'uses' => 'CompanyController@getLatestJobs'));
    });
});

Route::group(['prefix' => 'admin'], function()
{
    Route::group(['namespace' => 'Company'], function(){
        Route::get('rest/api/companies', array('as' => 'company.companies', 'uses' => 'CompanyController@getCompanyList'));
        Route::get('rest/api/latestjobs', array('as' => 'company.latestjobs', 'uses' => 'CompanyController@getLatestJobs'));
        Route::get('rest/api/latestapplications', array('as' => 'company.latestapplications', 'uses' => 'JobController@getLatestJobApplications'));
        Route::get('rest/api/listgroup', array('as' => 'admin.listgroup', 'uses' => 'CommonController@saveListGroups'));

    });

    Route::group(['namespace' => 'Common'], function(){
        Route::post('rest/api/listgroup', array('as' => 'admin.listgroup', 'uses' => 'CommonController@saveListGroups'));
        Route::post('rest/api/listentity', array('as' => 'admin.listentity', 'uses' => 'CommonController@saveListEntity'));
        Route::delete('rest/api/{listGroupId}/listgroup', array('as' => 'admin.deletelistgroup', 'uses' => 'CommonController@deleteListGroup'));
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

        Route::get('rest/api/candidatecount', array('as' => 'candidate.candidatecount', 'uses' => 'CandidateController@getCandidatesCount'));
        Route::post('rest/api/applyjob', array('as' => 'candidate.applyjob', 'uses' => 'CandidateController@applyForJob'));

        Route::group(['middleware' => 'jwt.auth'], function () {
            Route::post('rest/api/appliedjobs', array('as' => 'candidate.appliedjobs', 'uses' => 'CandidateController@trackJobStatus'));
        });

        //Route::get('rest/api/appliedjobs', array('as' => 'candidate.appliedjobs', 'uses' => 'CandidateController@trackJobStatus'));
        /*Route::get('rest/api/{companyId}/details', array('as' => 'company.companydetails', 'uses' => 'CompanyController@getCompanyDetails'));
        Route::get('rest/api/jobs', array('as' => 'company.jobs', 'uses' => 'JobController@getJobList'));
        Route::get('rest/api/jobs/{jobId}/details', array('as' => 'company.jobdetails', 'uses' => 'JobController@getJobDetails'));*/
    });
});



Route::group(['prefix' => 'job'], function()
{

    Route::group(['namespace' => 'Company'], function(){

        Route::get('rest/api/jobs', array('as' => 'jobs.list', 'uses' => 'JobController@getJobList'));
        Route::post('rest/api/jobs/quicksearch', array('as' => 'jobs.quicksearch', 'uses' => 'JobController@getJobListByQuickSearch'));
        Route::post('rest/api/jobs/basicsearch', array('as' => 'jobs.basicsearch', 'uses' => 'JobController@getJobListByBasicSearch'));
        Route::post('rest/api/jobs/advancesearch', array('as' => 'jobs.advancesearch', 'uses' => 'JobController@getJobListByAdvanceSearch'));
        Route::get('rest/api/jobs/{jobId}/details', array('as' => 'jobs.details', 'uses' => 'JobController@getJobDetails'));

    });

});

