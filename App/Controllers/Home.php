<?php 

namespace App\Controllers;
use \Core\View;
use \Core\Controller;
class Home extends Controller
{
    /**
     * Créer la vue
     * @return void
     */
    public function index()
    {
        View::render('Home/index.phtml',
        [
            'controller' => 'Home',
        ]);
    }
   
}