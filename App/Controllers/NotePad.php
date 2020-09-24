<?php

namespace App\Controllers;

use App\Models\Note;
use Core\View;
use Core\Controller;
use Core\Session;
use App\Models\user;
use App\Security\PasswordHash;
use App\Security\Validator;
use App\Security\Check;

class NotePad extends Controller
{

    /**
     * Créer la vue
     * @return void
     */
    public function index()
    {
        View::render('NotePad/index.phtml', []);
    }

    // public function return()
    // {
    //     $arr = array(
    //         'a' => [1,2,3],
    //         'b' => 2,
    //         'c' => 3,
    //         'd' => 4,
    //         'e' => 5
    //     );

    //     $test = json_encode($arr);
    //     header('Content-type: application/json');

    //     echo $test;
        
    //     $note = new note;
    //     $note = $note->getAllUserNote();
    //     $encodenote = json_encode($note);
    //     header('Content-type: application/json');
    //     echo $encodenote;
    // }


    public function register()
    {
        $userNameMessage = '';
        $emailMessage = '';
        $passwordMessage = '';

        $user = new User;
        

        if (isset($_POST['submit'])) {
            $validate = new Validator;
            $PostuserName = $_POST['userName'];
            $userName = $validate->validateUsername($PostuserName);

            $postEmail = $_POST['email'];
            $email = $validate->validateEmail($postEmail);

            $postPassword = $_POST['password'];
            $password = $validate->validatePassword($postPassword);

            $verifyEmail = $user->verifyEmail($postEmail);

            if ($userName === false) {
                $userNameMessage = 'votre username doit comporter entre 6 et 20 charactères';
            }
            if ($email === false) {
                $emailMessage = "votre email n'est pas valide";
            }

            if ($verifyEmail['email'] == $postEmail) {
                $emailMessage = "L'email est déjà utilisé";
            }

            if (!$verifyEmail) {
                $emailMessage = "l'email est déja utilisé";
            }

            if ($password === false) {
                $passwordMessage = "Votre password doit comporter entre 6 et 20 charactères ainsi qu'une majuscule et un charactère alphanumérique";
            }

            if ($userName === true && $email === true && $password === true && $verifyEmail === false) {
                $hasher = new PasswordHash;
                $password = $hasher->hashPass($postPassword);

                $user->registerUser($PostuserName, $postEmail, $password, 'user');
                header('Location: home');
            }
        }
        View::render('NotePad/register.phtml', [
            'userNameMessage' => $userNameMessage,
            'emailMessage' => $emailMessage,
            'passwordMessage' => $passwordMessage
            ]);
    }

    public function login()
    {
        $errorMessage = '';
        if (isset($_POST['submit'])) {
            $user = new User;
            $postEmail = $_POST['email'];
            $postPassword = $_POST['password'];
            $user = $user->verifyUser($postEmail);
            $password = password_verify($postPassword, $user['password']);

            if ($postEmail === $user['email'] && $password) {
                

                $session = new Session;
                $session->start();
                $session->init($user['email'], $user['id'], $user['username'], $user['role']);

                header('Location: home');
            } else {
                $errorMessage = "mauvaise combinaison utilisateur/mot de passe";
            }
        }
        View::render('NotePad/login.phtml', [
            'errorMessage' => $errorMessage,
        ]);
    }

    public function logout()
    {
        $session = new Session;
        $session->start();

        $check = new Check;
        $check->loggedIn();

        $session->stop();
        header('Location: login');
    }
    /**
     * affiche la vue Home
     */
    public function home()
    {
        $session = new Session;
        $session->start();
        $check = new Check;
        $check->loggedIn();
        $NoteAuthorID = $_SESSION['userID'];
        $note = new note;
        $note = $note->getAllUserNote($NoteAuthorID);
        $validator = new Validator;

        for ($i=0; $i < count($note) ; $i++) {
            $note[$i] = $validator->encodeCharArray($note[$i]);
        }
        // var_dump($note);
        View::render('NotePad/home.phtml', [
            'note' => $note,
        ]);
    }

    public function note()
    {
        $session = new Session;
        $session->start();

        $check = new Check;
        $check->loggedIn();
        $check->user();

        $noteId = $_GET['noteId'];
        $note = new note;
        $note = $note->getNote($noteId);

        $validator = new Validator;
        $note = $validator->encodeCharArray($note);
 
        View::render('NotePad/note.phtml', [
                'note' => $note,
        ]);
    }

    public function add()
    {
        $session = new Session;
        $session->start();
        $check = new Check;
        $check->loggedIn();

        if (isset($_POST['submit']))
        {
            $noteTitle = $_POST['noteTitle'];
            $noteContent = $_POST['noteContent'];
            $noteAuthorID = $_SESSION['userID'];
            $noteColor = 'red';
            $note = new Note;
                
            $note->addNote($noteTitle,$noteContent,$noteColor,$noteAuthorID);
            header('Location: home');

        }

            View::render('NotePad/add.phtml', [
                
            ]);
        
    }
    public function edit()
    {
        $session = new Session;
        $session->start();

        $check = new Check;
        $check->loggedIn();
        $check->user();

        $noteId = $_GET['noteId'];
        $note = new Note;
        $validator = new Validator;
        $noteArray = $note->getNote($noteId);
        $noteArray = $validator->encodeCharArray($noteArray);
    
        if (isset($_POST['submit']))
        {
            $noteTitle = $_POST['noteTitle'];
            $noteContent = $_POST['noteContent'];
            $note->editNote($noteTitle,$noteContent,$noteId);
            header("Location:home"); 
        }
        View::render('NotePad/edit.phtml', [
            'note' => $noteArray,
        ]);
    }

    public function delete()
    {
        $session = new Session;
        $session->start();

        
        $check = new Check;
        $check->loggedIn();
        $check->user();

        $noteId = $_GET['noteId'];
        $note = new Note;
        $note->deleteNote($noteId);
        header("Location:home");
        exit();
    }
}
