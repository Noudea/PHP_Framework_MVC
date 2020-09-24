<?php

namespace App\Security;

/**
 * class qui sert a valider les identifiant et email par rapport a des contraintes spécifique.
 * La class sert aussi a valider les informations pour se premunir contre l'injection de code malicieux(attaque XSS ect ... )
 */
class Validator
{   
    /**
     * @param string la string a encode
     * @return string string encodé safe
     * encode une string avec htmlspecialchars afin de se proteger des attaques XSS
     */
    function encodeChar($param)
    {

        $string = htmlspecialchars($param);

        return $string;
    }

    /**
     * @param array array a encoder
     * @return array array encoder
     * protèges les array contre les attaque XSS
     */
    function encodeCharArray($array)
    {
        $arrayToEncode = $array;
        foreach ($arrayToEncode as  $key => $value) {

            $string[$key] = htmlspecialchars($value);
        }
        return $string;
    }

    /**
     * @return boolean true si password valide
     * verifie si le password correspond au exigence pass < 20 et > 6 avec au moins 1 majuscle et 1 chiffres
     */
    public function validatePassword($password)
    {
        if (strlen($password) > 20 || strlen($password) < 6 || !preg_match('`[A-Z]`', $password) || !preg_match('`[0-9]`', $password)) 
        {
            return false;
        }	
        else
        {
            return true;
        }
    }

    /**
     * @return boolean true si email valide
     *  verifie que c'est bien un email
     */
    public function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            return false;
        } 
        else 
        {
           return true;
        }
    }

    /**
     * @return boolean true si userName valide
     * verifie si le username correspond au exigence pass < 20 et > 6 
     */
    public function validateUsername($userName)
    {
        if (strlen($userName) > 20 || strlen($userName) < 6) 
        {
            return false;
        } 
        else 
        {
            return true;
        }
    }
    
}
