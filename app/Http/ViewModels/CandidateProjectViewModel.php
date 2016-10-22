<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 22/10/2016
 * Time: 4:15 PM
 */

namespace App\Http\ViewModels;


class CandidateProjectViewModel
{
    private $candidateId;

    private $candidateProjectId;
    private $client;
    private $projectTitle;
    private $durationYearsFrom;
    private $durationMonthsFrom;
    private $durationYearsTo;
    private $durationMonthsTo;
    private $projectLocation;
    private $employmentStatus;
    private $projectDetails;
    private $skills;
    private $roleDescription;
    private $role;
    private $teamSize;

    private $candidateProjects;

    private $createdBy;
    private $updatedBy;
    private $createdAt;
    private $updatedAt;

    public function __construct()
    {
        $this->candidateProjects = array();
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
    public function getCandidateProjectId()
    {
        return $this->candidateProjectId;
    }

    /**
     * @param mixed $candidateProjectId
     */
    public function setCandidateProjectId($candidateProjectId)
    {
        $this->candidateProjectId = $candidateProjectId;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getProjectTitle()
    {
        return $this->projectTitle;
    }

    /**
     * @param mixed $projectTitle
     */
    public function setProjectTitle($projectTitle)
    {
        $this->projectTitle = $projectTitle;
    }

    /**
     * @return mixed
     */
    public function getDurationYearsFrom()
    {
        return $this->durationYearsFrom;
    }

    /**
     * @param mixed $durationYearsFrom
     */
    public function setDurationYearsFrom($durationYearsFrom)
    {
        $this->durationYearsFrom = $durationYearsFrom;
    }

    /**
     * @return mixed
     */
    public function getDurationMonthsFrom()
    {
        return $this->durationMonthsFrom;
    }

    /**
     * @param mixed $durationMonthsFrom
     */
    public function setDurationMonthsFrom($durationMonthsFrom)
    {
        $this->durationMonthsFrom = $durationMonthsFrom;
    }

    /**
     * @return mixed
     */
    public function getDurationYearsTo()
    {
        return $this->durationYearsTo;
    }

    /**
     * @param mixed $durationYearsTo
     */
    public function setDurationYearsTo($durationYearsTo)
    {
        $this->durationYearsTo = $durationYearsTo;
    }

    /**
     * @return mixed
     */
    public function getDurationMonthsTo()
    {
        return $this->durationMonthsTo;
    }

    /**
     * @param mixed $durationMonthsTo
     */
    public function setDurationMonthsTo($durationMonthsTo)
    {
        $this->durationMonthsTo = $durationMonthsTo;
    }

    /**
     * @return mixed
     */
    public function getProjectLocation()
    {
        return $this->projectLocation;
    }

    /**
     * @param mixed $projectLocation
     */
    public function setProjectLocation($projectLocation)
    {
        $this->projectLocation = $projectLocation;
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
    public function getProjectDetails()
    {
        return $this->projectDetails;
    }

    /**
     * @param mixed $projectDetails
     */
    public function setProjectDetails($projectDetails)
    {
        $this->projectDetails = $projectDetails;
    }

    /**
     * @return mixed
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @param mixed $skills
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;
    }

    /**
     * @return mixed
     */
    public function getRoleDescription()
    {
        return $this->roleDescription;
    }

    /**
     * @param mixed $roleDescription
     */
    public function setRoleDescription($roleDescription)
    {
        $this->roleDescription = $roleDescription;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getTeamSize()
    {
        return $this->teamSize;
    }

    /**
     * @param mixed $teamSize
     */
    public function setTeamSize($teamSize)
    {
        $this->teamSize = $teamSize;
    }

    /**
     * @return mixed
     */
    public function getCandidateProjects()
    {
        return $this->candidateProjects;
    }

    /**
     * @param mixed $candidateProjects
     */
    public function setCandidateProjects($candidateProjects)
    {
        array_push($this->candidateProjects, (object) $candidateProjects);
        //$this->candidateProjects = $candidateProjects;
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