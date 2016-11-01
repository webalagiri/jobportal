<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/15/2016
 * Time: 5:24 PM
 */

namespace App\jobportal\repositories\repointerface;


use App\Http\ViewModels\ApplyJobViewModel;
use App\Http\ViewModels\CandidateEmploymentViewModel;
use App\Http\ViewModels\CandidatePreferencesViewModel;
use App\Http\ViewModels\CandidateProjectViewModel;
use App\Http\ViewModels\CandidateSkillsViewModel;
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
    public function saveCandidateSkills(CandidateSkillsViewModel $candidateSkillsVM);
    public function saveCandidateEmployment(CandidateEmploymentViewModel $candidateEmpVM);
    public function saveCandidateProjects(CandidateProjectViewModel $candidateProjectsVM);
    public function saveCandidatePreferences(CandidatePreferencesViewModel $candidatePreferencesVM);

    public function getCandidatesCount();
    public function applyForJob(ApplyJobViewModel $applyJobVM);
}