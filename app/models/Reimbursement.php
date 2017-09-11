<?php

require_once CORE . 'Model.php';

class Reimbursement extends Model
{
    public $tableName = 'reimbursements';

    public $name;
    public $contact;
    public $reason;
    public $amount;
    public $link;
    public $fieldNames = array(
        "name",
        "contact",
        "reason",
        "amount",
        "link"
    );

    public function save()
    {
        $sql = "INSERT INTO " . $this->tableName . " (name,reason,amount,contact,approve,link,fund) VALUES (" .
                $this->name . "," . $this->reason . "," . $this->amount . "," . $this->contact . ",'0','" . $this->link . "','general');";

        $query = $this->db->prepare($sql);

        return $query->execute();
    }

    public function updateReimbursementByReview()
    {
        $sql = "UPDATE " . $this->tableName . " SET approve='" . $_POST['approve'] . "',fund='" .
                $_POST['fund'] . "',reimbursed='" . $_POST['reimbursed'] . "'";
        if ($_POST['check'] !== '') {
            $sql = $sql . ",`check`=" . $_POST['check'];
        }
        $sql = $sql . " WHERE id=" . $_POST['id'] . ";";

        $query = $this->db->prepare($sql);

        return $query->execute();
    }
}
