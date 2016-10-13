<?php
namespace App\jobportal\utilities\ErrorEnum;

use MyCLabs\Enum\Enum;

class ErrorEnum extends Enum{

    const SUCCESS = 1;
    const FAILURE = 0;
    const UNKNOWN_ERROR = 100;

    //const USER_NOT_FOUND_ERROR = 101;

    //Master Data constants 101 to 120;
    const MASTER_DATA_ERROR = 101;
    const LIST_ENTITY_ERROR = 102;
    const LIST_GROUP_ERROR = 103;
    const LIST_GROUP_SUCCESS = 104;

}
