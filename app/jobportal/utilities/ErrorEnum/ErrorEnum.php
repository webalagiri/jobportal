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
    const NO_LIST_ENTITY_FOUND = 106;
    const CITY_LIST_ERROR = 107;
    const CITY_LIST_SUCCESS = 108;
    const NO_CITY_LIST_FOUND = 109;
    const COUNTRY_LIST_ERROR = 110;
    const COUNTRY_LIST_SUCCESS = 111;
    const NO_COUNTRY_LIST_FOUND = 112;

    const NEW_LIST_GROUP_SAVE_ERROR = 113;
    const NEW_LIST_GROUP_SAVE_SUCCESS = 114;
    const NEW_LIST_ENTITY_SAVE_ERROR = 115;
    const NEW_LIST_ENTITY_SAVE_SUCCESS = 116;

    const USER_LOGIN_ERROR = 117;
    const USER_LOGIN_SUCCESS = 118;
    const FORGOT_LOGIN_ERROR = 119;
    const FORGOT_LOGIN_SUCCESS = 120;
    const CHANGE_PASSWORD_ERROR = 121;
    const CHANGE_PASSWORD_SUCCESS = 122;
    const USER_LOGOUT_ERROR = 123;
    const USER_LOGOUT_SUCCESS = 124;



    //Company constants 131 to 175
    const COMPANY_LIST_ERROR = 131;
    const COMPANY_LIST_SUCCESS = 132;
    const COMPANY_DETAILS_ERROR = 133;
    const COMPANY_DETAILS_SUCCESS = 134;
    const COMPANY_PROFILE_SAVE_ERROR = 135;
    const COMPANY_PROFILE_SAVE_SUCCESS = 136;
    const COMPANY_PROFILE_DELETE_ERROR = 137;
    const COMPANY_PROFILE_DELETE_SUCCESS = 138;
    const NO_COMPANY_LIST_FOUND = 139;
    const INDUSTRY_LIST_ERROR = 140;
    const INDUSTRY_LIST_SUCCESS = 141;
    const NO_INDUSTRY_LIST_FOUND = 142;
    //const NEW_COMPANY_SAVE_ERROR = 137;
    //const NEW_COMPANY_SAVE_SUCCESS = 138;
    const COMPANY_LOGIN_ERROR = 143;
    const COMPANY_LOGIN_SUCCESS = 144;
    const COMPANY_FORGOTLOGIN_ERROR = 145;
    const COMPANY_FORGOTLOGIN_SUCCESS = 146;
    const COMPANY_COUNT_ERROR = 147;
    const COMPANY_COUNT_SUCCESS = 148;
    const NO_COMPANY_COUNT_FOUND = 149;
    const COMPANY_INTERVIEW_LIST_ERROR = 150;
    const COMPANY_INTERVIEW_LIST_SUCCESS = 151;
    const NO_INTERVIEW_LIST_FOUND = 152;
    const FUNCTIONAL_AREAS_LIST_ERROR = 153;
    const FUNCTIONAL_AREAS_LIST_SUCCESS = 154;
    const NO_FUNCTIONAL_AREAS_LIST_FOUND = 155;

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
    const JOB_APPLICATION_LIST_ERROR = 186;
    const JOB_APPLICATION_LIST_SUCCESS = 187;
    const NO_JOB_APPLICATION_DETAILS_FOUND = 188;
    const JOB_COUNT_ERROR = 189;
    const JOB_COUNT_SUCCESS = 190;
    const NO_JOB_COUNT_FOUND = 191;
    const INTERVIEW_SCHEDULE_ERROR = 192;
    const INTERVIEW_SCHEDULE_SUCCESS = 193;

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
    const CANDIDATE_JOB_APPLY_ERROR = 231;
    const CANDIDATE_JOB_APPLY_SUCCESS = 232;

    const CANDIDATE_LOGIN_ERROR = 233;
    const CANDIDATE_LOGIN_SUCCESS = 234;
    const CANDIDATE_FORGOTLOGIN_ERROR = 235;
    const CANDIDATE_FORGOTLOGIN_SUCCESS = 236;

    const CANDIDATE_COUNT_ERROR = 237;
    const CANDIDATE_COUNT_SUCCESS = 238;
    const NO_CANDIDATE_COUNT_FOUND = 239;

    const CANDIDATE_APPLY_JOB_ERROR = 240;
    const CANDIDATE_APPLY_JOB_SUCCESS = 241;

    const CANDIDATE_OTHER_DETAILS_SAVE_ERROR = 242;
    const CANDIDATE_OTHER_DETAILS_SAVE_SUCCESS = 243;
    const CANDIDATE_TRACK_JOBSTATUS_ERROR = 244;
    const CANDIDATE_TRACK_JOBSTATUS_SUCCESS = 245;
    const NO_CANDIDATE_TRACK_STATUS_FOUND = 246;
    const CANDIDATE_INTERVIEW_SCHEDULE_ERROR = 247;
    const CANDIDATE_INTERVIEW_SCHEDULE_SUCCESS = 248;

}
