<?php

class Controller
{
    public $databaseConnection = null;

    public function __construct()
    {
        $this->openDatabaseConnection();
    }

    public function openDatabaseConnection()
    {
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        try {
            $this->databaseConnection = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USERNAME, DB_PASSWORD, $options);
        } catch (PDOException $e) {
            print 'Connection failed: ' . $e->getMessage();
            exit;
        }
    }

    public function render($action)
    {
        if ((!isset($action) || $action === '') && method_exists($this, 'index')) {
            $this->index();
        } else if (isset($action) && method_exists($this, $action)) {
            $this->$action();
        } else {
            $this->error();
        }
    }

    public function respond($status, $message)
    {
        print json_encode(array(
            "status" => $status,
            "message" => $message
        ));
    }

    public function error()
    {
        require_once CONTROLLERS . 'ErrorController.php';
        $errorController = new ErrorController;
        $errorController->render('index');
    }
}
