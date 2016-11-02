<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/14/2016
 * Time: 3:15 PM
 */

namespace App\jobportal\repositories\repointerface;


use App\Http\ViewModels\JobViewModel;

interface JobInterface
{
    //public function getJobList();
    public function getJobListByQuickSearch($searchJob);
    public function getJobListByBasicSearch($searchJob);
    public function getJobListByAdvanceSearch($searchJob);

    public function getJobList($searchKey = null);
    public function getJobDetails($jobId);
    public function saveJobProfile(JobViewModel $jobVM);
    public function deleteJob($jobId);

    public function getLatestJobApplications();

    public function getJobCount();
}