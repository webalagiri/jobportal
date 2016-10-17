<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/15/2016
 * Time: 5:24 PM
 */

namespace App\jobportal\repositories\repoimpl;


use App\jobportal\repositories\repointerface\CandidateInterface;
use App\jobportal\utilities\ErrorEnum\ErrorEnum;
use App\jobportal\utilities\Exception\CandidateException;


use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Exception;

class CandidateImpl implements CandidateInterface
{

    /* Get list of candidates
     * @params none
     * @throws $candidateException
     * @return array | null
     * @author Baskar
     */

    public function getCandidates()
    {
        $candidates = null;
        //dd('Inside candidate impl');

        try
        {
            $query = DB::table('ri_candidate_personal_profile as rcpp')->join('users as usr', 'usr.id', '=', 'rcpp.candidate_id');
            $query->join('ri_candidate_job_profile as rcjp', 'rcjp.candidate_id', '=', 'usr.id');
            $query->join('ri_list_entities as rle', 'rle.id', '=', 'rcpp.city');
            $query->where('usr.delete_status', '=', 1);
            $query->select('rcpp.id as Id', 'rcpp.candidate_id as candidateId', 'rcpp.candidate_name as candidateName',
                'rcpp.email as email', 'rcpp.phone as phone', 'rle.list_entity_name as city', 'rcpp.gender as gender',
                'rcjp.profile_name as profileName', 'rcjp.profile_details as profileDetails',
                'rcjp.skills as skills', 'rcjp.total_experience as totalExperience');
            $query->orderBy('rcpp.candidate_name', 'ASC');

            $candidates = $query->get();
        }
        catch(QueryException $queryExc)
        {
            //dd($queryExc);
            throw new CandidateException(null, ErrorEnum::CANDIDATE_LIST_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            //dd($exc);
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
            $query = DB::table('ri_candidate_personal_profile as rcpp')->join('users as usr', 'usr.id', '=', 'rcpp.candidate_id');
            $query->join('ri_candidate_job_profile as rcjp', 'rcjp.candidate_id', '=', 'usr.id');
            $query->join('ri_list_entities as rle', 'rle.id', '=', 'rcpp.city');
            $query->where('rcpp.candidate_id', '=', $candidateId);
            $query->where('usr.delete_status', '=', 1);
            $query->select('rcpp.id as Id', 'rcpp.candidate_id as candidateId', 'rcpp.candidate_name as candidateName',
                'rcpp.email as email', 'rcpp.phone as phone', 'rle.city as city', 'rcpp.gender as gender',
                'rcjp.profile_name as profileName', 'rcjp.profile_details as profileDetails',
                'rcjp.skills as skills', 'rcjp.total_experience as totalExperience');

            $candidateDetails = $query->get();
        }
        catch(QueryException $queryExc)
        {
            throw new CandidateException(null, ErrorEnum::CANDIDATE_DETAILS_ERROR, $queryExc);
        }
        catch(Exception $exc)
        {
            throw new CandidateException(null, ErrorEnum::CANDIDATE_DETAILS_ERROR, $exc);
        }

        return $candidateDetails;
    }
}