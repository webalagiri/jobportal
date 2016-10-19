<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/15/2016
 * Time: 5:36 PM
 */

namespace App\jobportal\services;

use App\jobportal\repositories\repointerface\CandidateInterface;
use App\jobportal\utilities\Exception\CandidateException;
use App\jobportal\utilities\ErrorEnum\ErrorEnum;

use Illuminate\Support\Facades\DB;
use Exception;

class CandidateService
{
    protected $candidateRepo;

    public function __construct(CandidateInterface $candidateRepo)
    {
        $this->candidateRepo = $candidateRepo;
    }

    /* Get list of candidates
     * @params none
     * @throws $candidateException
     * @return array | null
     * @author Baskar
     */

    public function getCandidates()
    {
        $candidates = null;

        try
        {
            $candidates = $this->candidateRepo->getCandidates();
        }
        catch(CandidateException $candidateExc)
        {
            throw $candidateExc;
        }
        catch(Exception $exc)
        {
            throw new CandidateException(null, ErrorEnum::CANDIDATE_LIST_ERROR, $exc);
        }

        return $candidates;
    }

    /* Get candidate details
     * @params $companyId
     * @throws $companyExc
     * @return array | null
     * @author Baskar
     */

    public function getCandidateDetails($candidateId)
    {
        $candidateDetails = null;

        try
        {
            $candidateDetails = $this->candidateRepo->getCandidateDetails($candidateId);
        }
        catch(CandidateException $candidateExc)
        {
            throw $candidateExc;
        }
        catch(Exception $exc)
        {
            throw new CandidateException(null, ErrorEnum::COMPANY_DETAILS_ERROR, $exc);
        }

        return $candidateDetails;
    }

    /* Save candidate profile
     * @params $candidateProfileVM
     * @throws $candidateExc
     * @return true | false
     * @author Baskar
     */

    public function saveCandidateProfile($candidateProfileVM)
    {
        $status = true;

        try
        {
            DB::transaction(function() use ($candidateProfileVM, &$status)
            {
                $status = $this->candidateRepo->saveCandidateProfile($candidateProfileVM);
            });

        }
        catch(CandidateException $candidateExc)
        {
            $status = false;
            throw $candidateExc;
        }
        catch (Exception $ex) {

            $status = false;
            throw new CandidateException(null, ErrorEnum::CANDIDATE_PROFILE_SAVE_ERROR, $ex);
        }

        return $status;
    }

    /* Delete a candidate
     * @params $candidateId
     * @throws $candidateException
     * @return true | false
     * @author Baskar
     */

    public function deleteCandidate($candidateId)
    {
        $status = true;

        try
        {
            DB::transaction(function() use ($candidateId, &$status)
            {
                $status = $this->candidateRepo->deleteCandidate($candidateId);
            });

        }
        catch(CandidateException $candidateExc)
        {
            $status = false;
            throw $candidateExc;
        }
        catch (Exception $ex) {

            $status = false;
            throw new CandidateException(null, ErrorEnum::CANDIDATE_PROFILE_DELETE_ERROR, $ex);
        }

        return $status;
    }

    /* Get candidate skills
     * @params $candidateId
     * @throws $candidateException
     * @return true | false
     * @author Baskar
     */

    public function getCandidateSkills($candidateId)
    {
        $candidateSkills = null;

        try
        {
            $candidateSkills = $this->candidateRepo->getCandidateSkills($candidateId);
        }
        catch(CandidateException $candidateExc)
        {
            throw $candidateExc;
        }
        catch(Exception $exc)
        {
            throw new CandidateException(null, ErrorEnum::CANDIDATE_SKILLS_LIST_ERROR, $exc);
        }

        return $candidateSkills;
    }

    /* Get candidate employment details
     * @params $candidateId
     * @throws $candidateException
     * @return array | null
     * @author Baskar
     */

    public function getCandidateEmployment($candidateId)
    {
        $candidateEmployment = null;

        try
        {
            $candidateEmployment = $this->candidateRepo->getCandidateEmployment($candidateId);
        }
        catch(CandidateException $candidateExc)
        {
            throw $candidateExc;
        }
        catch(Exception $exc)
        {
            throw new CandidateException(null, ErrorEnum::CANDIDATE_EMPLOYMENT_LIST_ERROR, $exc);
        }

        return $candidateEmployment;
    }

    /* Get candidate project details
     * @params $candidateId
     * @throws $candidateException
     * @return array | null
     * @author Baskar
     */

    public function getCandidateProjects($candidateId)
    {
        $candidateProjects = null;

        try
        {
            $candidateProjects = $this->candidateRepo->getCandidateProjects($candidateId);
        }
        catch(CandidateException $candidateExc)
        {
            throw $candidateExc;
        }
        catch(Exception $exc)
        {
            throw new CandidateException(null, ErrorEnum::CANDIDATE_PROJECTS_LIST_ERROR, $exc);
        }

        return $candidateProjects;
    }

    /* Get candidate preferences
     * @params $candidateId
     * @throws $candidateException
     * @return array | null
     * @author Baskar
     */

    public function getCandidatePreferences($candidateId)
    {
        $candidatePreferences = null;

        try
        {
            $candidatePreferences = $this->candidateRepo->getCandidatePreferences($candidateId);
        }
        catch(CandidateException $candidateExc)
        {
            throw $candidateExc;
        }
        catch(Exception $exc)
        {
            throw new CandidateException(null, ErrorEnum::CANDIDATE_PREFERENCES_LIST_ERROR, $exc);
        }

        return $candidatePreferences;
    }
}