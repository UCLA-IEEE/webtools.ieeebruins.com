<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Reimbursements - IEEE Webtools</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/public/favicon.ico">

    <!-- JQUERY -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

    <!-- BOOTSTRAP-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- STYLESHEETS -->
    <link rel='stylesheet' type='text/css' href='/public/css/style.css' />
    <link rel='stylesheet' type='text/css' href='/public/css/form.css' />

    <!-- SCRIPTS -->
    <script src='/public/js/reimbursements.js'></script>
</head>
<body>
    <!-- NAVBAR -->
    <?php include('./views/includes/navbar.php'); ?>

    <div class="container">
        <h1 class="col-md-6 col-md-offset-3 text-center">Reimbursement Form</h1>

        <div class="col-md-6 col-md-offset-3">
            <form class="form webtools-form reimbursement-form" enctype='multipart/form-data'>
                <div class="form-group">
                    <label for="name" class="control-label">Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label for="contact" class="control-label">Contact Phone # / Email / Venmo</label>
                    <input class="form-control" type="text" name="contact" required>
                </div>
                <div class="form-group">
                    <label for="reason" class="control-label">Reason for reimbursement?</label>
                    <textarea class="form-control" name="reason" rows="4" cols="40" required></textarea>
                </div>
                <div class="form-group">
                    <label for="amount" class="control-label">Amount to be reimbursed</label>
                    <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input class="form-control" type="text" name="amount" required>
                    </div>
                </div>
                <div class="form-group">
                    <input type="hidden" name="MAX_FILE_SIZE" value="20000000"/>
                    <label for="file" class="control-label">Upload a receipt<br/>(2MB size limit. JPEG/PDF only)</label>
                    <input class="form-control" name="receipt" type="file" required/>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary form-control">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
