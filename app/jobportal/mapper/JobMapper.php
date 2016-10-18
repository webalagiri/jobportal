<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/16/2016
 * Time: 2:49 PM
 */

namespace App\jobportal\mapper;


use App\Http\ViewModels\JobViewModel;
use Illuminate\Http\Request;

class JobMapper
{
    public static function setJobProfile(Request $jobRequest)
    {
        $jobVM = new JobViewModel();
        $job = (object) $jobRequest->all();

        //$userName = Session::get('DisplayName');
        $userName = 'Admin';

        $jobVM->setJobId($job->jobId);
        $jobVM->setCompanyId($job->companyId);
        $jobVM->setJobPostName($job->jobPostName);
        $jobVM->setJobDescription($job->jobDescription);
        $jobVM->setJobPostType($job->jobPostType);
        $jobVM->setJobVacancy($job->jobVacancy);
        $jobVM->setJobExperience($job->jobExperience);
        $jobVM->setJobSalaryMin($job->jobSalaryMin);
        $jobVM->setJobSalaryMax($job->jobSalaryMax);
        $jobVM->setJobSkills($job->jobSkills);
        $jobVM->setJobIndustryArea($job->jobIndustryArea);
        $jobVM->setJobFunctionalArea($job->jobFunctionalArea);
        $jobVM->setJobActiveFrom(date("Y-m-d H:i:s"));
        $jobVM->setJobActiveTo(date("Y-m-d H:i:s"));
        $jobVM->setJobStatus(1);
        $jobVM->setCreatedBy($userName);
        $jobVM->setUpdatedBy($userName);
        $jobVM->setCreatedAt(date("Y-m-d H:i:s"));
        $jobVM->setUpdatedAt(date("Y-m-d H:i:s"));

        return $jobVM;
    }
}