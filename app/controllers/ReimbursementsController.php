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
        require_once VIEWS . 'reimbursements/browse.php';
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
}
