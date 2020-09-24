<?php

namespace App\Security;

class PasswordHash {

    /**
     * @param string le password a hash
     * sert a hasg le password
     */
    public function hashPass($password)
    {
        $hashedpassword = password_hash($password, PASSWORD_BCRYPT);

        return $hashedpassword;

    }

    /**
     * @param string $pass POST PASSWORD
     * @param $hash le password hasher
     * @return boolean 
     * dehash le password et verifie si il correspond bien
     */
    public function deHashPass($pass,$hash)
    {
        $password = password_verify($pass, $hash);

        return $password;
    }



}