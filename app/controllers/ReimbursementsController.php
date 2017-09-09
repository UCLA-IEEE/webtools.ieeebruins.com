<?php

require_once CORE . 'Controller.php';

class ReimbursementsController extends Controller
{
    public function index()
    {
        require_once VIEWS . 'reimbursements/index.php';
    }
}
