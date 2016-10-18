<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/17/2016
 * Time: 2:24 PM
 */

namespace App\Http\ViewModels;


class CandidateViewModel
{
    private $candidateId;
    private $firstName;
    private $lastName;
    private $email;
    private $phone;
    private $mobile;
    private $location;
    private $address;
    private $alternateMobile;
    private $city;
    private $country;
    private $pincode;
    private $gender;
    private $dateOfBirth;
    private $maritalStatus;
    private $physicallyChallenged;
    private $photo;
    private $currentSalary;
    private $expectedSalary;
    private $jobTitle;
    private $skills;
    private $totalYearsExperience;
    private $totalMonthsExperience;
    private $currentLocation;
    private $preferredLocation;
    private $resume;

    private $createdBy;
    private $updatedBy;
    private $createdAt;
    private $updatedAt;

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
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param mixed $mobile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
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
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getAlternateMobile()
    {
        return $this->alternateMobile;
    }

    /**
     * @param mixed $alternateMobile
     */
    public function setAlternateMobile($alternateMobile)
    {
        $this->alternateMobile = $alternateMobile;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getPincode()
    {
        return $this->pincode;
    }

    /**
     * @param mixed $pincode
     */
    public function setPincode($pincode)
    {
        $this->pincode = $pincode;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @param mixed $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return mixed
     */
    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    /**
     * @param mixed $maritalStatus
     */
    public function setMaritalStatus($maritalStatus)
    {
        $this->maritalStatus = $maritalStatus;
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
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getCurrentSalary()
    {
        return $this->currentSalary;
    }

    /**
     * @param mixed $currentSalary
     */
    public function setCurrentSalary($currentSalary)
    {
        $this->currentSalary = $currentSalary;
    }

    /**
     * @return mixed
     */
    public function getExpectedSalary()
    {
        return $this->expectedSalary;
    }

    /**
     * @param mixed $expectedSalary
     */
    public function setExpectedSalary($expectedSalary)
    {
        $this->expectedSalary = $expectedSalary;
    }

    /**
     * @return mixed
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * @param mixed $jobTitle
     */
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;
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
    public function getTotalYearsExperience()
    {
        return $this->totalYearsExperience;
    }

    /**
     * @param mixed $totalYearsExperience
     */
    public function setTotalYearsExperience($totalYearsExperience)
    {
        $this->totalYearsExperience = $totalYearsExperience;
    }

    /**
     * @return mixed
     */
    public function getTotalMonthsExperience()
    {
        return $this->totalMonthsExperience;
    }

    /**
     * @param mixed $totalMonthsExperience
     */
    public function setTotalMonthsExperience($totalMonthsExperience)
    {
        $this->totalMonthsExperience = $totalMonthsExperience;
    }

    /**
     * @return mixed
     */
    public function getCurrentLocation()
    {
        return $this->currentLocation;
    }

    /**
     * @param mixed $currentLocation
     */
    public function setCurrentLocation($currentLocation)
    {
        $this->currentLocation = $currentLocation;
    }

    /**
     * @return mixed
     */
    public function getPreferredLocation()
    {
        return $this->preferredLocation;
    }

    /**
     * @param mixed $preferredLocation
     */
    public function setPreferredLocation($preferredLocation)
    {
        $this->preferredLocation = $preferredLocation;
    }

    /**
     * @return mixed
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * @param mixed $resume
     */
    public function setResume($resume)
    {
        $this->resume = $resume;
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