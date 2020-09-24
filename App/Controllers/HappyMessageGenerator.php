<?php 

namespace App\Controllers;

use Core\Controller;
use \Core\View;

class HappyMessageGenerator extends Controller
{
    public function index()
    {
        View::render('HappyMessageGenerator/index.phtml',
        [
            'controller' => 'Home',
        ]);
    }
}