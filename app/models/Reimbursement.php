<?php

require_once CORE . 'Model.php';

class Reimbursement extends Model
{
    public $tableName = 'reimbursements';

    public $name;
    public $contact;
    public $reason;
    public $amount;
    public $fieldNames = array(
        "name",
        "contact",
        "reason",
        "amount"
    );
}
