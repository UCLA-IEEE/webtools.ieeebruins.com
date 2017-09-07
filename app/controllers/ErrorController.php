<?php

require_once CORE . 'Controller.php';
define('ERROR_VIEWS', VIEWS . 'error/');

class ErrorController extends Controller
{
    public function index()
    {
        require_once ERROR_VIEWS . 'error.php';
    }
}
