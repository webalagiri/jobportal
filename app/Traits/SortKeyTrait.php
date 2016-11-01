<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 30/10/2016
 * Time: 2:54 PM
 */

namespace App\Traits;


trait SortKeyTrait
{
    private $jobSortKeys = array(
        "companyName" => "usr.name",
        "jobPostName" => "rj.job_post_name",
        "jobPostType" => "rle.list_entity_name",
        "activeFrom" =>  "rj.job_active_from",
        "activeTo" => "rj.job_active_to"
    );

    private $companySortKeys = array(
        "companyName" => "rcp.company_name"
    );

    public function getSortKeyArray()
    {
        return $this->jobSortKeys;
    }

    public function getCompanySortKeyArray()
    {
        return $this->companySortKeys;
    }

    public function getJobSortValue($key)
    {
        $sortValue = $this->jobSortKeys[$key];
        return $sortValue;
    }

    public function getCompanySortValue($key)
    {
        $sortValue = $this->companySortKeys[$key];
        return $sortValue;
    }
}