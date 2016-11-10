<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 07/11/2016
 * Time: 1:08 PM
 */

namespace App\Http\ViewModels;


class TrackStatusViewModel
{
    private $candidateId;
    private $statusId;

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
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * @param mixed $statusId
     */
    public function setStatusId($statusId)
    {
        $this->statusId = $statusId;
    }


}