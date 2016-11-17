<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 07/11/2016
 * Time: 8:42 PM
 */

namespace App\Http\ViewModels;


class ScheduleInterviewViewModel
{
    private $jobInterviewId;
    private $jobId;
    private $candidateId;
    private $jobApplicationId;
    private $companyId;
    private $interviewLocation;
    private $interviewDate;
    private $interviewTime;

    private $candidates;

    private $createdBy;
    private $updatedBy;
    private $createdAt;
    private $updatedAt;

    /**
     * @return mixed
     */
    public function getJobInterviewId()
    {
        return $this->jobInterviewId;
    }

    /**
     * @param mixed $jobInterviewId
     */
    public function setJobInterviewId($jobInterviewId)
    {
        $this->jobInterviewId = $jobInterviewId;
    }

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
    public function getJobApplicationId()
    {
        return $this->jobApplicationId;
    }

    /**
     * @param mixed $jobApplicationId
     */
    public function setJobApplicationId($jobApplicationId)
    {
        $this->jobApplicationId = $jobApplicationId;
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
    public function getInterviewLocation()
    {
        return $this->interviewLocation;
    }

    /**
     * @param mixed $interviewLocation
     */
    public function setInterviewLocation($interviewLocation)
    {
        $this->interviewLocation = $interviewLocation;
    }

    /**
     * @return mixed
     */
    public function getInterviewDate()
    {
        return $this->interviewDate;
    }

    /**
     * @param mixed $interviewDate
     */
    public function setInterviewDate($interviewDate)
    {
        $this->interviewDate = $interviewDate;
    }

    /**
     * @return mixed
     */
    public function getInterviewTime()
    {
        return $this->interviewTime;
    }

    /**
     * @param mixed $interviewTime
     */
    public function setInterviewTime($interviewTime)
    {
        $this->interviewTime = $interviewTime;
    }

    /**
     * @return mixed
     */
    public function getCandidates()
    {
        return $this->candidates;
    }

    /**
     * @param mixed $candidates
     */
    public function setCandidates($candidates)
    {
        $this->candidates = $candidates;
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