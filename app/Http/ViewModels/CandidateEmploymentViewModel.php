<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21/10/2016
 * Time: 12:05 PM
 */

namespace App\Http\ViewModels;


class CandidateEmploymentViewModel
{
    private $candidateId;
    private $companyName;
    private $designation;
    private $experienceYears;
    private $experienceMonths;
    private $employmentStatus;
    private $durationFromYears;
    private $durationFromMonths;
    private $durationToYears;
    private $durationToMonths;
    private $annualSalary;
    private $noticePeriod;
    private $candidateEmp;

    private $createdBy;
    private $updatedBy;
    private $createdAt;
    private $updatedAt;

    public function __construct()
    {
        $this->candidateEmp = array();
    }

    /**
     * @return mixed
     */
    public function getCandidateId()
    {
        return $this->candidateId;
    }

    /**
     * @param mixed $candidateId
     */
    public function setCandidateId($candidateId)
    {
        $this->candidateId = $candidateId;
    }

    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param mixed $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }

    /**
     * @return mixed
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * @param mixed $designation
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;
    }

    /**
     * @return mixed
     */
    public function getExperienceYears()
    {
        return $this->experienceYears;
    }

    /**
     * @param mixed $experienceYears
     */
    public function setExperienceYears($experienceYears)
    {
        $this->experineceYears = $experienceYears;
    }

    /**
     * @return mixed
     */
    public function getExperienceMonths()
    {
        return $this->experienceMonths;
    }

    /**
     * @param mixed $experienceMonths
     */
    public function setExperienceMonths($experienceMonths)
    {
        $this->experienceMonths = $experienceMonths;
    }

    /**
     * @return mixed
     */
    public function getEmploymentStatus()
    {
        return $this->employmentStatus;
    }

    /**
     * @param mixed $employmentStatus
     */
    public function setEmploymentStatus($employmentStatus)
    {
        $this->employmentStatus = $employmentStatus;
    }

    /**
     * @return mixed
     */
    public function getDurationFromYears()
    {
        return $this->durationFromYears;
    }

    /**
     * @param mixed $durationFromYears
     */
    public function setDurationFromYears($durationFromYears)
    {
        $this->durationFromYears = $durationFromYears;
    }

    /**
     * @return mixed
     */
    public function getDurationFromMonths()
    {
        return $this->durationFromMonths;
    }

    /**
     * @param mixed $durationFromMonths
     */
    public function setDurationFromMonths($durationFromMonths)
    {
        $this->durationFromMonths = $durationFromMonths;
    }

    /**
     * @return mixed
     */
    public function getDurationToYears()
    {
        return $this->durationToYears;
    }

    /**
     * @param mixed $durationToYears
     */
    public function setDurationToYears($durationToYears)
    {
        $this->durationToYears = $durationToYears;
    }

    /**
     * @return mixed
     */
    public function getDurationToMonths()
    {
        return $this->durationToMonths;
    }

    /**
     * @param mixed $durationToMonths
     */
    public function setDurationToMonths($durationToMonths)
    {
        $this->durationToMonths = $durationToMonths;
    }

    /**
     * @return mixed
     */
    public function getAnnualSalary()
    {
        return $this->annualSalary;
    }

    /**
     * @param mixed $annualSalary
     */
    public function setAnnualSalary($annualSalary)
    {
        $this->annualSalary = $annualSalary;
    }

    /**
     * @return mixed
     */
    public function getNoticePeriod()
    {
        return $this->noticePeriod;
    }

    /**
     * @param mixed $noticePeriod
     */
    public function setNoticePeriod($noticePeriod)
    {
        $this->noticePeriod = $noticePeriod;
    }

    /**
     * @return mixed
     */
    public function getCandidateEmp()
    {
        return $this->candidateEmp;
    }

    /**
     * @param mixed $candidateEmp
     */
    public function setCandidateEmp($candidateEmp)
    {
        array_push($this->candidateEmp, (object) $candidateEmp);
        //$this->candidateEmp = $candidateEmp;
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