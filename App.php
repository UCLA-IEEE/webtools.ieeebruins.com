<?php

class App
{
    private $url_controller = null;
    private $url_action = null;
    private $url_params = array();

    public function __construct()
    {
        $this->splitUrl();

        if (!$this->url_controller) {
            require_once CONTROLLERS . 'MainController.php';
            $mainController = new MainController;
            $mainController->render('index');
        } else if (file_exists(APP . 'controllers/' . ucfirst($this->url_controller) . 'Controller.php')) {
            require_once CONTROLLERS . ucfirst($this->url_controller) . 'Controller.php';
            $controllerName = ucfirst($this->url_controller) . 'Controller';
            $controller = new $controllerName();
            $controller->render($this-> url_action);
        } else {
            require_once CONTROLLERS . 'ErrorController.php';
            $errorController = new ErrorController;
            $errorController->render('index');
        }
    }

    private function splitUrl()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

        $this->url_controller = isset($url[0]) ? $url[0] : null;
        $this->url_action = isset($url[1]) ? $url[1] : null;

        unset($url[0], $url[1]);

        $this->url_params = array_values($url);
    }
}
