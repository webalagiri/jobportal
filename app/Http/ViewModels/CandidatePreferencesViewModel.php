<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 22/10/2016
 * Time: 5:52 PM
 */

namespace App\Http\ViewModels;


class CandidatePreferencesViewModel
{
    private $candidateId;

    private $candidatePreferenceId;
    private $jobType;
    private $employmentType;
    private $industry;
    private $recommendedCompanies;
    private $dreamCompanies;
    private $preferredSkills;
    private $companiesInterviewedWith;
    private $preferredRoles;
    private $candidatePreferences;

    private $createdBy;
    private $updatedBy;
    private $createdAt;
    private $updatedAt;

    public function __construct()
    {
        $this->candidatePreferences = array();
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
    public function getCandidatePreferenceId()
    {
        return $this->candidatePreferenceId;
    }

    /**
     * @param mixed $candidatePreferenceId
     */
    public function setCandidatePreferenceId($candidatePreferenceId)
    {
        $this->candidatePreferenceId = $candidatePreferenceId;
    }

    /**
     * @return mixed
     */
    public function getJobType()
    {
        return $this->jobType;
    }

    /**
     * @param mixed $jobType
     */
    public function setJobType($jobType)
    {
        $this->jobType = $jobType;
    }

    /**
     * @return mixed
     */
    public function getEmploymentType()
    {
        return $this->employmentType;
    }

    /**
     * @param mixed $employmentType
     */
    public function setEmploymentType($employmentType)
    {
        $this->employmentType = $employmentType;
    }

    /**
     * @return mixed
     */
    public function getIndustry()
    {
        return $this->industry;
    }

    /**
     * @param mixed $industry
     */
    public function setIndustry($industry)
    {
        $this->industry = $industry;
    }

    /**
     * @return mixed
     */
    public function getRecommendedCompanies()
    {
        return $this->recommendedCompanies;
    }

    /**
     * @param mixed $recommendedCompanies
     */
    public function setRecommendedCompanies($recommendedCompanies)
    {
        $this->recommendedCompanies = $recommendedCompanies;
    }

    /**
     * @return mixed
     */
    public function getDreamCompanies()
    {
        return $this->dreamCompanies;
    }

    /**
     * @param mixed $dreamCompanies
     */
    public function setDreamCompanies($dreamCompanies)
    {
        $this->dreamCompanies = $dreamCompanies;
    }

    /**
     * @return mixed
     */
    public function getPreferredSkills()
    {
        return $this->preferredSkills;
    }

    /**
     * @param mixed $preferredSkills
     */
    public function setPreferredSkills($preferredSkills)
    {
        $this->preferredSkills = $preferredSkills;
    }

    /**
     * @return mixed
     */
    public function getCompaniesInterviewedWith()
    {
        return $this->companiesInterviewedWith;
    }

    /**
     * @param mixed $companiesInterviewedWith
     */
    public function setCompaniesInterviewedWith($companiesInterviewedWith)
    {
        $this->companiesInterviewedWith = $companiesInterviewedWith;
    }

    /**
     * @return mixed
     */
    public function getPreferredRoles()
    {
        return $this->preferredRoles;
    }

    /**
     * @param mixed $preferredRoles
     */
    public function setPreferredRoles($preferredRoles)
    {
        $this->preferredRoles = $preferredRoles;
    }

    /**
     * @return mixed
     */
    public function getCandidatePreferences()
    {
        return $this->candidatePreferences;
    }

    /**
     * @param mixed $candidatePreferences
     */
    public function setCandidatePreferences($candidatePreferences)
    {
        array_push($this->candidatePreferences, (object) $candidatePreferences);
        //$this->candidatePreferences = $candidatePreferences;
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