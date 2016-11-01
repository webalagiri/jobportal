<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 26/10/2016
 * Time: 4:38 PM
 */

namespace App\Http\ViewModels;


class ListGroupVM
{
    private $listGroupId;
    private $listGroupName;
    private $listGroupCode;
    private $deleteStatus;
    private $createdBy;
    private $updatedBy;
    private $createdAt;
    private $updatedAt;

    /**
     * @return mixed
     */
    public function getListGroupId()
    {
        return $this->listGroupId;
    }

    /**
     * @param mixed $listGroupId
     */
    public function setListGroupId($listGroupId)
    {
        $this->listGroupId = $listGroupId;
    }

    /**
     * @return mixed
     */
    public function getListGroupName()
    {
        return $this->listGroupName;
    }

    /**
     * @param mixed $listGroupName
     */
    public function setListGroupName($listGroupName)
    {
        $this->listGroupName = $listGroupName;
    }

    /**
     * @return mixed
     */
    public function getListGroupCode()
    {
        return $this->listGroupCode;
    }

    /**
     * @param mixed $listGroupCode
     */
    public function setListGroupCode($listGroupCode)
    {
        $this->listGroupCode = $listGroupCode;
    }

    /**
     * @return mixed
     */
    public function getDeleteStatus()
    {
        return $this->deleteStatus;
    }

    /**
     * @param mixed $deleteStatus
     */
    public function setDeleteStatus($deleteStatus)
    {
        $this->deleteStatus = $deleteStatus;
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