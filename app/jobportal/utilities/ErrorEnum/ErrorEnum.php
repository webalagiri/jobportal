<?php
namespace App\jobportal\utilities\ErrorEnum;

use MyCLabs\Enum\Enum;

class ErrorEnum extends Enum{

    const SUCCESS = 1;
    const FAILURE = 0;
    const UNKNOWN_ERROR = 100;

    //const USER_NOT_FOUND_ERROR = 101;

    //Master Data constants 101 to 125;
    const MASTER_DATA_ERROR = 101;
    const LIST_ENTITY_ERROR = 102;
    const LIST_GROUP_ERROR = 103;
    const LIST_GROUP_SUCCESS = 104;

    const LIST_ENTITY_SUCCESS = 105;

    //Company constants 131 to 175
    const COMPANY_LIST_ERROR = 131;
    const COMPANY_LIST_SUCCESS = 132;
    const COMPANY_DETAILS_ERROR = 133;
    const COMPANY_DETAILS_SUCCESS = 134;
    const COMPANY_PROFILE_SAVE_ERROR = 135;
    const COMPANY_PROFILE_SAVE_SUCCESS = 136;
    //const NEW_COMPANY_SAVE_ERROR = 137;
    //const NEW_COMPANY_SAVE_SUCCESS = 138;

    //Job constants 176 to 200
    const JOB_LIST_ERROR = 176;
    const JOB_LIST_SUCCESS = 177;
    const JOB_DETAILS_ERROR = 178;
    const JOB_DETAILS_SUCCESS = 179;
    const NO_JOB_LIST_FOUND = 180;
    const NO_JOB_DETAILS_FOUND = 181;
    const JOB_PROFILE_SAVE_ERROR = 182;
    const JOB_PROFILE_SAVE_SUCCESS = 183;

    //Candidate constants 201 to 240
    const CANDIDATE_LIST_ERROR = 201;
    const CANDIDATE_LIST_SUCCESS = 202;
    const NO_CANDIDATE_LIST_FOUND = 203;
    const CANDIDATE_DETAILS_ERROR = 204;
    const CANDIDATE_DETAILS_SUCCESS = 205;
    const NO_CANDIDATE_DETAILS_FOUND = 206;


}
