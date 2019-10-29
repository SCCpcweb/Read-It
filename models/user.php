<?php

class user
{
    private $userID, $username, $email, $password;

    public function __construct($userID, $username, $email, $password)
    {
        $this->userID = $userID;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    // getters
    public function getUserID()
    {
        return $this->userID;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    // setters
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}
