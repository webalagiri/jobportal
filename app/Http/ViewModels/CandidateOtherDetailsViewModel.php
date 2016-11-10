<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 06/11/2016
 * Time: 3:12 PM
 */

namespace App\Http\ViewModels;


class CandidateOtherDetailsViewModel
{
    private $candidateId;

    private $candidateOtherDetailsId;
    private $passportAvailability;
    private $drivingLicense;
    private $passportExpiryYear;
    private $candidateCategory;
    private $physicallyChallenged;
    private $profileName;
    private $url;
    private $workPermit;
    private $otherCountries;

    private $languages;

    private $createdBy;
    private $updatedBy;
    private $createdAt;
    private $updatedAt;

    public function __construct()
    {
        $this->languages = array();
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
    public function getCandidateOtherDetailsId()
    {
        return $this->candidateOtherDetailsId;
    }

    /**
     * @param mixed $candidateOtherDetailsId
     */
    public function setCandidateOtherDetailsId($candidateOtherDetailsId)
    {
        $this->candidateOtherDetailsId = $candidateOtherDetailsId;
    }

    /**
     * @return mixed
     */
    public function getPassportAvailability()
    {
        return $this->passportAvailability;
    }

    /**
     * @param mixed $passportAvailability
     */
    public function setPassportAvailability($passportAvailability)
    {
        $this->passportAvailability = $passportAvailability;
    }

    /**
     * @return mixed
     */
    public function getDrivingLicense()
    {
        return $this->drivingLicense;
    }

    /**
     * @param mixed $drivingLicense
     */
    public function setDrivingLicense($drivingLicense)
    {
        $this->drivingLicense = $drivingLicense;
    }

    /**
     * @return mixed
     */
    public function getPassportExpiryYear()
    {
        return $this->passportExpiryYear;
    }

    /**
     * @param mixed $passportExpiryYear
     */
    public function setPassportExpiryYear($passportExpiryYear)
    {
        $this->passportExpiryYear = $passportExpiryYear;
    }

    /**
     * @return mixed
     */
    public function getCandidateCategory()
    {
        return $this->candidateCategory;
    }

    /**
     * @param mixed $candidateCategory
     */
    public function setCandidateCategory($candidateCategory)
    {
        $this->candidateCategory = $candidateCategory;
    }

    /**
     * @return mixed
     */
    public function getPhysicallyChallenged()
    {
        return $this->physicallyChallenged;
    }

    /**
     * @param mixed $physicallyChallenged
     */
    public function setPhysicallyChallenged($physicallyChallenged)
    {
        $this->physicallyChallenged = $physicallyChallenged;
    }

    /**
     * @return mixed
     */
    public function getProfileName()
    {
        return $this->profileName;
    }

    /**
     * @param mixed $profileName
     */
    public function setProfileName($profileName)
    {
        $this->profileName = $profileName;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getWorkPermit()
    {
        return $this->workPermit;
    }

    /**
     * @param mixed $workPermit
     */
    public function setWorkPermit($workPermit)
    {
        $this->workPermit = $workPermit;
    }

    /**
     * @return mixed
     */
    public function getOtherCountries()
    {
        return $this->otherCountries;
    }

    /**
     * @param mixed $otherCountries
     */
    public function setOtherCountries($otherCountries)
    {
        $this->otherCountries = $otherCountries;
    }

    /**
     * @return mixed
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * @param mixed $languages
     */
    public function setLanguages($languages)
    {
        //$this->languages = $languages;
        array_push($this->languages, (object) $languages);
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