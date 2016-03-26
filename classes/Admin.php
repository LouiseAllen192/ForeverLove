<?php

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
    public function __construct($admin)
    {
        $this->adminId = $admin->Admin_id;
        $this->firstName = $admin ->firstName;
        $this->lastName = $admin ->lastName;
        $this->password = $admin -> password;
        $this->emailAddress =$admin -> Email;
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