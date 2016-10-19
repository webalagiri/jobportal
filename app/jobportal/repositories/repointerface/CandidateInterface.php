<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/15/2016
 * Time: 5:24 PM
 */

namespace App\jobportal\repositories\repointerface;


use App\Http\ViewModels\CandidateViewModel;

interface CandidateInterface
{
    public function getCandidates();
    public function getCandidateDetails($candidateId);
    public function saveCandidateProfile(CandidateViewModel $candidateVM);
    public function deleteCandidate($candidateId);
    public function getCandidateSkills($candidateId);
    public function getCandidateEmployment($candidateId);
    public function getCandidateProjects($candidateId);
    public function getCandidatePreferences($candidateId);
}