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
        $jobVM->setLocation(property_exists($job, 'location') ? $job->location : null);
        //$jobVM->setJobDescription($job->jobDescription);
        $jobVM->setJobDescription(property_exists($job, 'jobDescription') ? $job->jobDescription : null);
        $jobVM->setJobPostType($job->jobPostType);
        $jobVM->setJobVacancy(property_exists($job, 'jobVacancy') ? $job->jobVacancy : null);
        $jobVM->setJobExperience(property_exists($job, 'jobExperience') ? $job->jobExperience : null);
        $jobVM->setJobSalaryMin(property_exists($job, 'jobSalaryMin') ? $job->jobSalaryMin : null);
        $jobVM->setJobSalaryMax(property_exists($job, 'jobSalaryMax') ? $job->jobSalaryMax : null);
        $jobVM->setJobSkills(property_exists($job, 'jobSkills') ? $job->jobSkills : null);
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