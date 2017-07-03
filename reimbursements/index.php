<!DOCTYPE HTML>
<html>
<head>
    <title>Reimbursements - Webtools</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="../public/favicon.ico" />

    <!-- JQUERY -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- STYLESHEETS -->
    <link rel='stylesheet' href='./reimbursements/public/style.css' />
    <link rel='stylesheet' href='./reimbursements/public/form.css' />
</head>
<body>

    <!-- NAVBAR -->
    <?php include('../views/includes/navbar.html'); ?>

    <!-- REIMBURSEMENT FORM -->
    <div class="form-wrapper">
        <h1 class="text-center">Reimbursement Form</h1>

        <form enctype="multipart/form-data" action="./reimbursements/db/submitReimbursement.php" method="POST" class="form">
            <!-- NAME -->
            <div class="form-group">
                <label for="name" class="control-label">Name</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>

            <!-- CONTACT INFO -->
            <div class="form-group">
                <label for="contact" class="control-label">Contact Phone # / Email / Venmo</label>
                <input class="form-control" type="text" name="contact" id="contact">
            </div>

            <!-- REASON -->
            <div class="form-group">
                <label for="reason" class="control-label">Reason for reimbursement?</label>
                <textarea class="form-control" id="reason" rows="5" cols="40" name="reason"></textarea>
            </div>

            <!-- REIMBURSEMENT AMOUNT -->
            <div class="form-group">
                <label for="amount" class="control-label">Amount to be reimbursed</label>
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input class="form-control" type="text" name="amount" id="amount">
                </div>
            </div>

            <!-- RECEIPT -->
            <div class="form-group">
                <input type="hidden" name="MAX_FILE_SIZE" value="20000000"/>
                <label for="file" class="control-label">
                    Upload a receipt<br/>(2MB size limit. JPEG/PDF only)
                </label>
                <input class="form-control" name="receipt" type="file" id="file"/>
            </div>

            <!-- SUBMIT -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary form-control">Submit</button>
            </div>
        </form>
    </div>

    <!-- FOOTER -->
    <?php include('../views/includes/footer.html'); ?>

</body>
</html>
