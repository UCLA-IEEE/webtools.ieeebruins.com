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

        if ($_GET['filter'] === 'pending') {
            $params = array('approve' => '0');
        } else if ($_GET['filter'] === 'approved') {
            $params = array('approve' => '1');
        } else if ($_GET['filter'] === "denied") {
            $params = array('approve' => '2');
        } else if ($_GET['filter'] === 'all') {
            $params = array();
        } else {
            $params = array('approve' => '0');
        }

        $reimbursements = $reimbursement->find($params);
        usort($reimbursements, function($a, $b) {
            return $b->id - $a->id;
        });
        foreach ($reimbursements as $reimbursement) {
            $this->formatReimbursement($reimbursement);
        }
        require_once VIEWS . 'reimbursements/browse.php';
    }

    public function review()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->getReview();
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->postReview();
        }
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
                $message = 'Hello from webtools';
                $mailStatus = mail('jeffschan97@gmail.com', 'TEST EMAIL', $message);
                $this->respond('success', 'Successfully saved reimbursement! Feel free to submit another one.');
            }
        }
    }

    private function deleteReimbursements()
    {
        $reimbursement = new Reimbursement($this->databaseConnection);
        $reimbursements = $reimbursement->find();
        foreach ($reimbursements as $tempReimbursement) {
            unlink($tempReimbursement->link);
        }
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
            $reimbursement->reimbursed = 'Yes. <br />Check# ' . $reimbursement->check;
        }

        // remove check field from reimbursement object
        unset($reimbursement->check);
    }

    private function getReview()
    {
        require_once VIEWS . 'reimbursements/review.php';
    }

    private function postReview()
    {
        if ($_POST['approve'] === '2' && ($_POST['reimbursed'] == "1" || $_POST['check'] !== '')) {
            $this->respond('failure', "You can't deny a reimbursement and reimburse an individual!");
            exit;
        }

        if ($_POST['reimbursed'] === '1' && $_POST['check'] === '') {
            $this->respond('failure', "You cannot reimburse someone without a check number.");
            exit;
        }

        $reimbursement = new Reimbursement($this->databaseConnection);
        if (!$reimbursement->updateReimbursementByReview()) {
            $this->respond('failure', 'Failed to update reimbursement record!');
        } else {
            $this->respond('success', 'Successfully edited reimbursement record. Feel free to review another one!');
        }
    }
}
