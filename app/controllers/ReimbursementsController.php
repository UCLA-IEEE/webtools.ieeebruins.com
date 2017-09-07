<?php

require_once CORE . 'Controller.php';
define('REIMBURSEMENT_VIEWS', VIEWS . 'reimbursements' . DIRECTORY_SEPARATOR);

class ReimbursementsController extends Controller
{
    public function index()
    {
        require_once REIMBURSEMENT_VIEWS . 'index.php';
    }
}
