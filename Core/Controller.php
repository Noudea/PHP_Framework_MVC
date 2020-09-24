<?php

namespace Core;

abstract class Controller 
{
    /**
     * Créer la vue, methode obligatoire
     */
    abstract function index();

    function error ()
    {

        View::render('Error/index.phtml', [
            
        ]);
    }
}
