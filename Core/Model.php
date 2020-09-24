<?php

Namespace Core;
use PDO;
use App\config;
use PDOException;

class Model
{
    /**
     * créer la connection a la base de donnée
     */
    protected static function getDB()
    {
        static $db = null;

        if($db === null)
        {
            try 
            {
                $dsn = 'mysql:host=' . config::db_host .';dbname =' .config::db_name . ';charset=utf8';

                $pdo = new PDO($dsn, config::db_user, config::db_password);
                $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
                $pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
                
            } catch (PDOException $e) {
                echo 'Une Erreur est survenue : ' . $e->getMessage() . ' / ' . $e->getCode();
                die;
            }
        }
    }
}