<?php

namespace Core;

class Session
{
    /**
     * initialise la session
     */
    public function start()
    {
        session_start();
    }

    /**
     * @param mixed string ou int
     * stock les informations dans la session, usermail userid username role
     */
    public function init($userEmail,$userID,$username,$userRole)
    {
        $_SESSION['userEmail'] = $userEmail;
        $_SESSION['userID'] = $userID;
        $_SESSION['userUsername'] = $username;
        $_SESSION['role'] = $userRole;
    }
    /**
     * detruit la session
     */
    public function stop()
    {
        session_destroy();
        // unset($_SESSION['userID']);
    }

}
