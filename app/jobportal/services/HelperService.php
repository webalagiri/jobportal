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

use Illuminate\Support\Facades\DB;
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

    /* Get list entity by parent Id
     * @params $parentId
     * @throws HelperException
     * @return array | null
     * @author Baskar
     */

    public function getListEntityByParentId($parentId)
    {
        $listEntities = null;

        try
        {
            $listEntities = $this->helperRepo->getListEntityByParentId($parentId);
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

    /* Get the list of cities
    * @params none
    * @throws HelperException
    * @return array | null
    * @author Baskar
    */

    public function getCities()
    {
        $cities = null;

        try
        {
            $cities = $this->helperRepo->getCities();
        }
        catch(HelperException $helperExc)
        {
            throw $helperExc;
        }
        catch(Exception $exc)
        {
            throw new HelperException(null, ErrorEnum::CITY_LIST_ERROR, $exc);
        }

        return $cities;
    }

    /* Get the list of countries
    * @params none
    * @throws HelperException
    * @return array | null
    * @author Baskar
    */

    public function getCountries()
    {
        $countries = null;

        try
        {
            $countries = $this->helperRepo->getCountries();
        }
        catch(HelperException $helperExc)
        {
            throw $helperExc;
        }
        catch(Exception $exc)
        {
            throw new HelperException(null, ErrorEnum::COUNTRY_LIST_ERROR, $exc);
        }

        return $countries;
    }

    /* Save new list group
     * @params $listGroupVM
     * @throws HelperException
     * @return true | false
     * @author Baskar
     */

    public function saveListGroups($listGroupVM)
    {
        $status = true;

        try
        {
            DB::transaction(function() use ($listGroupVM, &$status)
            {
                $status = $this->helperRepo->saveListGroups($listGroupVM);
            });

        }
        catch(HelperException $helperExc)
        {
            $status = false;
            throw $helperExc;
        }
        catch (Exception $ex) {

            $status = false;
            throw new HelperException(null, ErrorEnum::COMPANY_PROFILE_SAVE_ERROR, $ex);
        }

        return $status;
    }

    /* Save new list entity
     * @params $listEntityVM
     * @throws HelperException
     * @return true | false
     * @author Baskar
     */

    public function saveListEntity($listEntityVM)
    {
        $status = true;

        try
        {
            DB::transaction(function() use ($listEntityVM, &$status)
            {
                $status = $this->helperRepo->saveListEntity($listEntityVM);
            });

        }
        catch(HelperException $helperExc)
        {
            $status = false;
            throw $helperExc;
        }
        catch (Exception $ex) {

            $status = false;
            throw new HelperException(null, ErrorEnum::NEW_LIST_ENTITY_SAVE_ERROR, $ex);
        }

        return $status;
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