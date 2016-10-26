<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/11/2016
 * Time: 7:17 PM
 */

namespace App\jobportal\services;

use App\jobportal\repositories\repointerface\HelperInterface;
use App\jobportal\utilities\Exception\HelperException;
use App\jobportal\utilities\ErrorEnum\ErrorEnum;

use Exception;

class HelperService
{
    protected $helperRepo;

    public function __construct(HelperInterface $helperRepo)
    {
        $this->helperRepo = $helperRepo;
    }

    /* Get list entity data by group Id
     * @params $groupId
     * @throws HelperException
     * @return array | null
     * @author Baskar
     */

    public function getListEntityByGroupId($groupId)
    {
        $listEntities = null;

        try
        {
            $listEntities = $this->helperRepo->getListEntityByGroupId($groupId);
        }
        catch(HelperException $helperExc)
        {
            throw $helperExc;
        }
        catch(Exception $exc)
        {
            throw new HelperException(null, ErrorEnum::LIST_ENTITY_ERROR, $exc);
        }

        return $listEntities;
    }

    /* Get list groups
     * @params none
     * @throws HelperException
     * @return array | null
     * @author Baskar
     */

    public function getListGroups()
    {
        $listGroups = null;

        try
        {
            $listGroups = $this->helperRepo->getListGroups();
        }
        catch(HelperException $helperExc)
        {
            throw $helperExc;
        }
        catch(Exception $exc)
        {
            throw new HelperException(null, ErrorEnum::LIST_GROUP_ERROR, $exc);
        }

        return $listGroups;
    }

    /* Get all list entities
    * @params none
    * @throws HelperException
    * @return array | null
    * @author Baskar
    */

    public function getListEntities()
    {
        $listEntities = null;

        try
        {
            $listEntities = $this->helperRepo->getListEntities();
        }
        catch(HelperException $helperExc)
        {
            throw $helperExc;
        }
        catch(Exception $exc)
        {
            throw new HelperException(null, ErrorEnum::LIST_ENTITY_ERROR, $exc);
        }

        return $listEntities;
    }


    public function ForgotLogin($email)
    {
        $userSession=null;

        try
        {
            $userSession = $this->helperRepo->ForgotLogin($email);
        }
        catch(HelperException $helperExc)
        {
            throw $helperExc;
        }
        catch(Exception $exc)
        {
            throw new HelperException(null, ErrorEnum::FORGOT_LOGIN_ERROR, $exc);
        }

        return $userSession;
    }


    public function ChangePassword($passwordRequest)
    {
        $userSession=null;

        try
        {
            $userSession = $this->helperRepo->ChangePassword($passwordRequest);
        }
        catch(HelperException $helperExc)
        {
            throw $helperExc;
        }
        catch(Exception $exc)
        {
            throw new HelperException(null, ErrorEnum::CHANGE_PASSWORD_ERROR, $exc);
        }

        return $userSession;
    }
}