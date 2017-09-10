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
        } else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $this->deleteReimbursements();
        }
    }

    public function browse()
    {
        $reimbursement = new Reimbursement($this->databaseConnection);
        $reimbursements = $reimbursement->find();
        foreach ($reimbursements as $reimbursement) {
            $this->formatReimbursement($reimbursement);
        }
        require_once VIEWS . 'reimbursements/browse.php';
    }

    public function review()
    {
        require_once VIEWS . 'reimbursements/review.php';
    }

    private function getReimbursements()
    {
        require_once VIEWS . 'reimbursements/reimbursements.php';
    }

    private function postReimbursements()
    {
        @$fileType = $_FILES['receipt']['type'];
        @$fileSize = $_FILES['receipt']['size'] / 1024;
        @$fileError = $_FILES['receipt']['error'];

        if ($fileType !== "image/jpeg" && $fileType !== "application/pdf" && $fileType !== "application/text-plain:formatted") {
            $this->respond('failure', "Please submit a JPEG/PDF file that is less than 2 MB in size");
            exit;
        }

        if ($fileSize > 2000) {
            $this->respond('failure', 'Your file size is too big! Please limit to 2MB in size!');
            exit;
        }

        if ($fileError !== 0) {
            $this->respond('failure', "File upload failed. Please try again!");
            exit;
        }

        $tempDir = $_FILES['receipt']['tmp_name'];
        $fileName = basename($_FILES['receipt']['name']);

        if(strlen($fileName) > 90){
            $this->respond('failure', "File name is too long.");
            exit;
        }

        $targetDirectory = VIEWS . 'reimbursements/receipts/';
        $fileName = md5($fileName . strval(time())) . "." . substr($fileName,-3,3);
        $targetPath = $targetDirectory . $fileName;

        if (!file_exists($targetPath)) mkdir($targetDirectory);

        if (!move_uploaded_file($tempDir, $targetPath)) {
            $this->respond('failure', 'Failed to move uploaded file into a permanent directory!');
            exit;
        } else {
            $newReimbursement = new Reimbursement($this->databaseConnection, $_POST);
            $newReimbursement->link = $targetPath;
            if (!$newReimbursement->save()) {
                $this->respond('failure', 'Failed to save reimbursement into the database!');
            } else {
                $this->respond('success', 'Successfully saved reimbursement!');
            }
        }
    }

    private function deleteReimbursements()
    {
        $reimbursement = new Reimbursement($this->databaseConnection);
        if (!$reimbursement->remove()) {
            $this->respond('failure', 'Failed to remove reimbursements from the database!');
        } else {
            $this->respond('success', 'Successfully removed all reimbursements from the database!');
        }
    }

    private function formatReimbursement($reimbursement)
    {
        // format approval
        if ($reimbursement->approve === '0') {
            $reimbursement->approve = 'Pending';
        } else if ($reimbursement->approve === '1') {
            $reimbursement->approve = 'Approved';
        } else {
            $reimbursement->approve = 'Denied';
        }

        // format receipt link
        $reimbursement->link = '<a href="' . substr($reimbursement->link, 1) . '" target="blank">Receipt</a>';

        // format submission time
        $timeAndDateArray = explode(' ', $reimbursement->time);
        $date = explode('-', $timeAndDateArray[0]);
        $date = $date[1] . '/' . $date[2] . '/' . $date[0];
        $time = explode(':', $timeAndDateArray[1]);
        $AM = $time[0] - 12 < 0 ? 'AM' : 'PM';
        $time[0] = $time[0] % 12;
        unset($time[2]);
        $time = $time[0] . ':' . $time[1] . ' ' . $AM;

        $reimbursement->time = $date . ' ' . $time;

        // format reimbursement status
        if ($reimbursement->reimbursed === '0') {
            $reimbursement->reimbursed = 'No';
        } else {
            $reimbursement->reimbursed = 'Yes. <br />Check# :' . $reimbursement->check;
        }

        // remove check field from reimbursement object
        unset($reimbursement->check);
    }
}
