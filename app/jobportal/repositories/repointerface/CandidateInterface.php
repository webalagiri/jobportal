<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/15/2016
 * Time: 5:24 PM
 */

namespace App\jobportal\repositories\repointerface;


interface CandidateInterface
{
    public function getCandidates();
    public function getCandidateDetails($candidateId);
    public function deleteCandidate($candidateId);
}