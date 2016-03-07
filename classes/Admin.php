<?php

/**
 * Created by PhpStorm.
 * User: Garret
 * Date: 03-Mar-16
 * Time: 12:04 PM
 */
class Admin
{
    private $adminId ;
    private $firstName ;
    private $lastName ;
    private $password ;
    private $emailAddress ;

    /**
     * Admin constructor.
     * @param int $adminId
     * @param null $firstName
     * @param null $lastName
     * @param null $password
     * @param null $emailAddress
     */
    public function __Administrator($adminId, $firstName, $lastName, $password, $emailAddress)
    {
        $this->adminId = $adminId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->password = $password;
        $this->emailAddress = $emailAddress;
    }

    /**
     * @return int
     */
    public function getAdminId()
    {
        return $this->adminId;
    }
    /**
     * @return null
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return null
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return null
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }



}