<?php

namespace Project\Controllers;

use Core\Controller;

class IndexController extends Controller
{
    public function home()
    {
        $this->title = "Auth MVC";
        return $this->render('Index/home', ['text' => null]);
    }
}
