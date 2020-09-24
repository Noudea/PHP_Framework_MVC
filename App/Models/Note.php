<?php

namespace App\Models;

use \Core\Model;


class Note extends Model
{
    function __construct()
    {
        $this->db = static::getDB();
    }

    /**
     * @param int id de l'auteur 
     * @return array ttes les notes de l'auteur dans un array
     */
    function getAllUserNote($noteAuthorID)
    {
        $pdo = static::getDB();
        $sql = "SELECT note.id, noteTitle, noteContent, noteColor, noteAuthorID, noteDate FROM e3wa.note INNER JOIN e3wa.user ON e3wa.note.noteAuthorID = e3wa.user.id  WHERE noteAuthorID = :noteAuthorID";
        $query = $pdo->prepare($sql);
        $query->execute(
            [
                'noteAuthorID' => $noteAuthorID
            ]
        );
        $note = $query->fetchAll();
        return $note;
    }

    /**
     * @param int id de la note
     * @return array de la note
     * recupere un array par rapport a l'id de la note
     */
    function getNote($noteId)
    {
        $pdo = static::getDB();
        $sql = "SELECT * FROM e3wa.note WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->execute(
            [
                'id' => $noteId,
            ]
        );
        $note = $query->fetch();
        return $note;
    }
    /**
     * @param int id de la note
     * @return string int id de l'auteur de la note 
     */
    public function getNoteAuthorID($noteId)
    {
        $pdo = static::getDB();
        $sql = "SELECT noteAuthorID FROM e3wa.note WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->execute(
            [
                'id' => $noteId,
            ]
        );
        $note = $query->fetch();
        return $note[0];
    }
    /**
     * @param mixed string et int
     * permet de creer une nouvelle note
     */
    function addNote($noteTitle,$noteContent,$noteColor,$noteAuthorID)
    {
        $sql = "INSERT INTO e3wa.note (noteTitle,noteContent,noteColor,noteAuthorID,noteDate) VALUES (:noteTitle, :noteContent, :noteColor, :noteAuthorID, :noteDate)";
        $query = $this->db->prepare($sql);
        $query->execute([
            'noteTitle' => $noteTitle ,
            'noteContent' => $noteContent, 
            'noteColor' => $noteColor,
            'noteAuthorID' =>  $noteAuthorID,
            'noteDate' => date("m.d.y"),
            ]);
    }

    /**
     * @param mixed string et int 
     * permet de modifier une note 
     */
    function editNote($noteTitle,$noteContent,$noteId)
    {
        $sql =
        "UPDATE e3wa.note SET noteTitle = :updatetitle, noteContent = :updatecontent WHERE id = :addNote_id";

        $query = $this->db->prepare($sql);
        $query->execute([
            'updatetitle' => $noteTitle,
            'updatecontent' => $noteContent,
            'addNote_id' => $noteId
        ]);
    }
    
    /**
     * @param int id de la note
     * permet de supprimer une note par rapport a son id 
     */
    function deleteNote($noteId)
    {
        $sql = "DELETE FROM e3wa.note WHERE id = :id";

        $query = $this->db->prepare($sql);
        $query->execute([
            'id' => $noteId
            ]);
    }
    
    // public function registerUser($username, $email, $password, $role)
    // {
    //     $pdo = static::getDB();

    //     $sql = "INSERT INTO e3wa.user (username,email,password,created_at,roles) VALUES (:name, :email, :password, :created_at, :roles)";
    //     $query = $pdo->prepare($sql);
    //     $query->execute([
    //         'name' => $username,
    //         'email' => $email,
    //         'password' => $password,
    //         'created_at' => date("Y-m-d H:i:s"),
    //         'roles' => $role
    //     ]);
    // }

    // public function verifyEmail($email)
    // {
    //     $pdo = $this->db;
    //     $sql = "SELECT email FROM e3wa.user WHERE email = :email ";
    //     $query = $pdo->prepare($sql);
    //     $query->execute([
    //         'email' => $email,
    //     ]);
    //     $verify = $query->fetch();
    //     return $verify;
    // }

    // public function verifyUser($email)
    // {
    //     $sql = "SELECT * FROM e3wa.user WHERE email = :email ";
    //     $query = $this->db->prepare($sql);
    //     $query->execute([
    //         'email' => $email,
    //     ]);
    //     $verify = $query->fetch();
    //     return $verify;
    // }
}

// #Parameter#6ea24e4b