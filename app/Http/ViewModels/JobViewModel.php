<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/16/2016
 * Time: 2:51 PM
 */

namespace App\Http\ViewModels;


class JobViewModel
{
    private $jobId;
    private $companyId;
    private $jobPostName;
    private $jobDescription;
    private $jobPostType;
    private $location;
    private $jobVacancy;
    private $jobExperience;
    private $jobSalaryMin;
    private $jobSalaryMax;
    private $jobSkills;
    private $jobIndustryArea;
    private $jobFunctionalArea;
    private $jobActiveFrom;
    private $jobActiveTo;
    private $jobStatus;
    private $createdBy;
    private $updatedBy;
    private $createdAt;
    private $updatedAt;

    /**
     * @return mixed
     */
    public function getJobId()
    {
        return $this->jobId;
    }

    /**
     * @param mixed $jobId
     */
    public function setJobId($jobId)
    {
        $this->jobId = $jobId;
    }

    /**
     * @return mixed
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @param mixed $companyId
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;
    }

    /**
     * @return mixed
     */
    public function getJobPostName()
    {
        return $this->jobPostName;
    }

    /**
     * @param mixed $jobPostName
     */
    public function setJobPostName($jobPostName)
    {
        $this->jobPostName = $jobPostName;
    }

    /**
     * @return mixed
     */
    public function getJobDescription()
    {
        return $this->jobDescription;
    }

    /**
     * @param mixed $jobDescription
     */
    public function setJobDescription($jobDescription)
    {
        $this->jobDescription = $jobDescription;
    }

    /**
     * @return mixed
     */
    public function getJobPostType()
    {
        return $this->jobPostType;
    }

    /**
     * @param mixed $jobPostType
     */
    public function setJobPostType($jobPostType)
    {
        $this->jobPostType = $jobPostType;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getJobVacancy()
    {
        return $this->jobVacancy;
    }

    /**
     * @param mixed $jobVacancy
     */
    public function setJobVacancy($jobVacancy)
    {
        $this->jobVacancy = $jobVacancy;
    }

    /**
     * @return mixed
     */
    public function getJobExperience()
    {
        return $this->jobExperience;
    }

    /**
     * @param mixed $jobExperience
     */
    public function setJobExperience($jobExperience)
    {
        $this->jobExperience = $jobExperience;
    }

    /**
     * @return mixed
     */
    public function getJobSalaryMin()
    {
        return $this->jobSalaryMin;
    }

    /**
     * @param mixed $jobSalaryMin
     */
    public function setJobSalaryMin($jobSalaryMin)
    {
        $this->jobSalaryMin = $jobSalaryMin;
    }

    /**
     * @return mixed
     */
    public function getJobSalaryMax()
    {
        return $this->jobSalaryMax;
    }

    /**
     * @param mixed $jobSalaryMax
     */
    public function setJobSalaryMax($jobSalaryMax)
    {
        $this->jobSalaryMax = $jobSalaryMax;
    }

    /**
     * @return mixed
     */
    public function getJobSkills()
    {
        return $this->jobSkills;
    }

    /**
     * @param mixed $jobSkills
     */
    public function setJobSkills($jobSkills)
    {
        $this->jobSkills = $jobSkills;
    }

    /**
     * @return mixed
     */
    public function getJobIndustryArea()
    {
        return $this->jobIndustryArea;
    }

    /**
     * @param mixed $jobIndustryArea
     */
    public function setJobIndustryArea($jobIndustryArea)
    {
        $this->jobIndustryArea = $jobIndustryArea;
    }

    /**
     * @return mixed
     */
    public function getJobFunctionalArea()
    {
        return $this->jobFunctionalArea;
    }

    /**
     * @param mixed $jobFunctionalArea
     */
    public function setJobFunctionalArea($jobFunctionalArea)
    {
        $this->jobFunctionalArea = $jobFunctionalArea;
    }

    /**
     * @return mixed
     */
    public function getJobActiveFrom()
    {
        return $this->jobActiveFrom;
    }

    /**
     * @param mixed $jobActiveFrom
     */
    public function setJobActiveFrom($jobActiveFrom)
    {
        $this->jobActiveFrom = $jobActiveFrom;
    }

    /**
     * @return mixed
     */
    public function getJobActiveTo()
    {
        return $this->jobActiveTo;
    }

    /**
     * @param mixed $jobActiveTo
     */
    public function setJobActiveTo($jobActiveTo)
    {
        $this->jobActiveTo = $jobActiveTo;
    }

    /**
     * @return mixed
     */
    public function getJobStatus()
    {
        return $this->jobStatus;
    }

    /**
     * @param mixed $jobStatus
     */
    public function setJobStatus($jobStatus)
    {
        $this->jobStatus = $jobStatus;
    }

    /**
     * @return mixed
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param mixed $createdBy
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return mixed
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @param mixed $updatedBy
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

}