<?php

require_once CORE . 'Controller.php';
define('MAIN_VIEWS', VIEWS);

class MainController extends Controller
{
    public function index()
    {
        require_once MAIN_VIEWS . 'index.php';
    }
}
