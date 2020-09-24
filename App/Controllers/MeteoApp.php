<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;


class MeteoApp extends Controller
{
    /**
     * Créer la vue
     * @return void
     */
    public function index()
    {
        View::render('MeteoApp/index.phtml',
        [
            
        ]);
    }
}