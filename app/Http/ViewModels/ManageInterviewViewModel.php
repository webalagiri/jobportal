<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 07/11/2016
 * Time: 3:43 PM
 */

namespace App\Http\ViewModels;


class ManageInterviewViewModel
{
    private $jobId;
    private $filterId;

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
    public function getFilterId()
    {
        return $this->filterId;
    }

    /**
     * @param mixed $filterId
     */
    public function setFilterId($filterId)
    {
        $this->filterId = $filterId;
    }


}