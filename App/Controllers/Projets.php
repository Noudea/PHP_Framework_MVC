<?php 

namespace App\Controllers;

use Core\Controller;
use \Core\View;

class Projets extends Controller
{
    public function index()
    {
        $projets = ['projet1'=>'happyMessageGenerator',
        'projet2'=>'projet2'
    ];

        View::render('Projets/index.phtml',
        [
            'controller' => 'Projets',
            'projets' => $projets
        ]);
    }
}