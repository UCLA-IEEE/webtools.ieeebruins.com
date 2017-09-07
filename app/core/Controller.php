<?php

class Controller
{
    public function render($action)
    {
        if (!isset($action) && method_exists($this, 'index')) {
            $this->index();
        } else if (isset($action) && method_exists($this, $action)) {
            $this->$action();
        } else {
            $this->error();
        }
    }

    public function error()
    {
        require_once CONTROLLERS . 'ErrorController.php';
        $errorController = new ErrorController;
        $errorController->render('index');
    }
}
