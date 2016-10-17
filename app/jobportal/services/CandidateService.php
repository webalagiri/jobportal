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

}