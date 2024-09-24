<?php

namespace App\Controllers\App;

use App\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home()
    {
        $this->title = "Home";
        return render('app.home', $this->data);
    }
    
}