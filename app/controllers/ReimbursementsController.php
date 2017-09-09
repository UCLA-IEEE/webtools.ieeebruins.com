<?php

require_once CORE . 'Controller.php';
require_once MODELS . 'Reimbursement.php';

class ReimbursementsController extends Controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->getReimbursements();
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->postReimbursements();
        }
    }

    public function browse()
    {
        require_once VIEWS . 'reimbursements/browse.php';
    }

    private function getReimbursements()
    {
        require_once VIEWS . 'reimbursements/reimbursements.php';
    }

    private function postReimbursements()
    {
        $newReimbursement = new Reimbursement($this->databaseConnection, $_POST);
        if ($newReimbursement->save()) {
            $this->respond('success', 'Successfully saved reimbursement!');
        } else {
            $this->respond('failure', 'Failed to save reimbursement into the database!');
        }
    }
}
