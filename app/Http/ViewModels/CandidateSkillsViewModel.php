<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/19/2016
 * Time: 4:12 PM
 */

namespace App\Http\ViewModels;


class CandidateSkillsViewModel
{
    private $candidateId;
    private $candidateSkills;
    private $createdBy;
    private $updatedBy;
    private $createdAt;
    private $updatedAt;

    public function __construct()
    {
        $this->candidateSkills = array();
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
    public function getCandidateSkills()
    {
        return $this->candidateSkills;
    }

    /**
     * @param mixed $candidateSkills
     */
    public function setCandidateSkills($candidateSkills)
    {
        array_push($this->candidateSkills, (object) $candidateSkills);
        //$this->candidateSkills = $candidateSkills;
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