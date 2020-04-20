<?php

namespace Src\Authentication;

class AbdusAfterLogin
{
    public function __construct()
    {
        session_start();
        $_SESSION['loggedin'] = false;
        $_SESSION['username'] = false;
    }

    public function setAuthenticate($usename)
    {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $usename;
        return true;
    }

    public function logout()
    {
        unset($_SESSION['loggedin']);
        unset($_SESSION['username']);
        session_destroy();
    }

    public function getAuthenticatedUser()
    {
        return $_SESSION['username'];
    }

    public function checkIfAuthenticated($usename)
    {
        if ($this->setAuthenticate($usename)) {
            return true;
        }
        return false;
    }
}
