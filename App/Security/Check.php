<?php

namespace App\Security;
use App\Models\Note;


/**
 * cette classe sert a verifier si l'utilisateur est bien logger ou que les informations demander appartiennent bien à l'utilisateur
 */
class Check
{
    /**
     * Verifie si l'utilisateur est bien logged in, sinon redirection page de login
     */
    public function loggedIn ()
    {

        if (isset($_SESSION['userID'])) {
            return true;
        } else {
            header('Location: login');
            exit;
        }
    }

    /**
     * vérifie si les notes appartiennent bien à l'utilisateur connecté, sinon redirection vers une page d'erreur
     */
    public function user()
    {   
        $note = new Note;
        $userId = $_SESSION['userID'];
        $authorId = $note->getNoteAuthorID($_GET['noteId']);
     
        if($userId === $authorId)
        {
            return true;
        }
        else
        {
            header('Location: home');
            exit;
        }
    }

 
}
