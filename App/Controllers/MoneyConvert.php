<?php

namespace App\Controllers;

use Core\View;
use Core\Controller;

class MoneyConvert extends Controller
{
    public function index()
    {
        View::render('MoneyConvert/index.phtml',
            [
                
            ]);
    }
}