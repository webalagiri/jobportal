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
    const USER_LOGIN_ERROR = 106;
    const USER_LOGIN_SUCCESS = 107;
    const FORGOT_LOGIN_ERROR = 108;
    const FORGOT_LOGIN_SUCCESS = 109;
    const CHANGE_PASSWORD_ERROR = 110;
    const CHANGE_PASSWORD_SUCCESS = 111;

    //Company constants 131 to 175
    const COMPANY_LIST_ERROR = 131;
    const COMPANY_LIST_SUCCESS = 132;
    const COMPANY_DETAILS_ERROR = 133;
    const COMPANY_DETAILS_SUCCESS = 134;
    const COMPANY_PROFILE_SAVE_ERROR = 135;
    const COMPANY_PROFILE_SAVE_SUCCESS = 136;
    const COMPANY_PROFILE_DELETE_ERROR = 137;
    const COMPANY_PROFILE_DELETE_SUCCESS = 138;
    const COMPANY_LOGIN_ERROR = 139;
    const COMPANY_LOGIN_SUCCESS = 140;
    const COMPANY_FORGOTLOGIN_ERROR = 141;
    const COMPANY_FORGOTLOGIN_SUCCESS = 142;

    //Job constants 176 to 200
    const JOB_LIST_ERROR = 176;
    const JOB_LIST_SUCCESS = 177;
    const JOB_DETAILS_ERROR = 178;
    const JOB_DETAILS_SUCCESS = 179;
    const NO_JOB_LIST_FOUND = 180;
    const NO_JOB_DETAILS_FOUND = 181;
    const JOB_PROFILE_SAVE_ERROR = 182;
    const JOB_PROFILE_SAVE_SUCCESS = 183;
    const JOB_PROFILE_DELETE_ERROR = 184;
    const JOB_PROFILE_DELETE_SUCCESS = 185;

    //Candidate constants 201 to 260
    const CANDIDATE_LIST_ERROR = 201;
    const CANDIDATE_LIST_SUCCESS = 202;
    const NO_CANDIDATE_LIST_FOUND = 203;
    const CANDIDATE_DETAILS_ERROR = 204;
    const CANDIDATE_DETAILS_SUCCESS = 205;
    const NO_CANDIDATE_DETAILS_FOUND = 206;
    const CANDIDATE_PROFILE_DELETE_ERROR = 207;
    const CANDIDATE_PROFILE_DELETE_SUCCESS = 208;
    const CANDIDATE_PROFILE_SAVE_ERROR = 209;
    const CANDIDATE_PROFILE_SAVE_SUCCESS = 210;
    const CANDIDATE_SKILLS_LIST_ERROR = 211;
    const CANDIDATE_SKILLS_LIST_SUCCESS = 212;
    const CANDIDATE_SKILLS_NOT_FOUND = 213;
    const CANDIDATE_EMPLOYMENT_LIST_ERROR = 214;
    const CANDIDATE_EMPLOYMENT_LIST_SUCCESS = 215;
    const CANDIDATE_EMPLOYMENT_NOT_AVAILABLE = 216;
    const CANDIDATE_PROJECTS_LIST_ERROR = 217;
    const CANDIDATE_PROJECTS_LIST_SUCCESS = 218;
    const CANDIDATE_PROJECTS_NOT_AVAILABLE = 219;
    const CANDIDATE_PREFERENCES_LIST_ERROR = 220;
    const CANDIDATE_PREFERENCES_LIST_SUCCESS = 221;
    const CANDIDATE_PREFERENCES_NOT_AVAILABLE = 222;
    const CANDIDATE_SKILLS_SAVE_ERROR = 223;
    const CANDIDATE_SKILLS_SAVE_SUCCESS = 224;
    const CANDIDATE_EMPLOYMENT_SAVE_ERROR = 225;
    const CANDIDATE_EMPLOYMENT_SAVE_SUCCESS = 226;
    const CANDIDATE_PROJECTS_SAVE_ERROR = 227;
    const CANDIDATE_PROJECTS_SAVE_SUCCESS = 228;
    const CANDIDATE_PREFERENCES_SAVE_ERROR = 229;
    const CANDIDATE_PREFERENCES_SAVE_SUCCESS = 230;
    const CANDIDATE_LOGIN_ERROR = 231;
    const CANDIDATE_LOGIN_SUCCESS = 232;
    const CANDIDATE_FORGOTLOGIN_ERROR = 233;
    const CANDIDATE_FORGOTLOGIN_SUCCESS = 234;

}
