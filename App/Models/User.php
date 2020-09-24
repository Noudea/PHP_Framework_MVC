<?php

namespace App\Models;
use \Core\Model;


class User extends Model
{
    function __construct() 
    {
        $this->db = static::getDB();
    }

    /**
     * @return array
     * permet de recuper tout les users de la base de données
     */
    function getAllUser()
    {
        $pdo= static::getDB();
       $sql = "SELECT * FROM e3wa.user WHERE email = :email";
       $query = $pdo->prepare($sql);
       $query->execute(
           [
               'email'=> 'admin2@gmail.com'
           ]
       );
       $user = $query->fetchAll();
    }

    /**
     * @param mixed enregistre un nouvelle utilisateur
     */
    public function registerUser($username,$email,$password,$role)
    {
        $pdo= static::getDB();

        $sql ="INSERT INTO e3wa.user (username,email,password,created_at,role) VALUES (:name, :email, :password, :created_at, :role)";
        $query = $pdo->prepare($sql);
        $query->execute([
        'name' => $username,
        'email' => $email,
        'password' => $password,
        'created_at' => date("Y-m-d H:i:s"),
        'role' => $role
        ]);
    }

    /**
     * @param string email 
     * @return string email de l'utilisateur
     * verifie si l'email existe dans la BDD
     */
    public function verifyEmail($email)
    {
        $pdo = $this->db;
        $sql = "SELECT email FROM e3wa.user WHERE email = :email ";
        $query = $pdo->prepare($sql);
        $query->execute([
            'email' => $email,
        ]);
        $verify = $query->fetch();
        return $verify;
    }

    /**
     * @param string email 
     * @return string email de l'utilisateur
     * verifie si l'email existe dans la BDD
     */
    public function verifyUser($email)
    {
        $sql = "SELECT * FROM e3wa.user WHERE email = :email ";
        $query = $this->db->prepare($sql);
        $query->execute([
            'email' => $email,
        ]);
        $verify = $query->fetch();
        return $verify;

    }
}

