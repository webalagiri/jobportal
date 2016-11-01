<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 26/10/2016
 * Time: 8:46 PM
 */

namespace App\Http\ViewModels;


class ListEntityViewModel
{
    private $listGroupId;

    private $listEntityId;
    private $listEntityName;
    private $entityDescription;
    private $code;
    private $parentId;
    private $sequenceNo;
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
    public function getListEntityId()
    {
        return $this->listEntityId;
    }

    /**
     * @param mixed $listEntityId
     */
    public function setListEntityId($listEntityId)
    {
        $this->listEntityId = $listEntityId;
    }

    /**
     * @return mixed
     */
    public function getListEntityName()
    {
        return $this->listEntityName;
    }

    /**
     * @param mixed $listEntityName
     */
    public function setListEntityName($listEntityName)
    {
        $this->listEntityName = $listEntityName;
    }

    /**
     * @return mixed
     */
    public function getEntityDescription()
    {
        return $this->entityDescription;
    }

    /**
     * @param mixed $entityDescription
     */
    public function setEntityDescription($entityDescription)
    {
        $this->entityDescription = $entityDescription;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param mixed $parentId
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    /**
     * @return mixed
     */
    public function getSequenceNo()
    {
        return $this->sequenceNo;
    }

    /**
     * @param mixed $sequenceNo
     */
    public function setSequenceNo($sequenceNo)
    {
        $this->sequenceNo = $sequenceNo;
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