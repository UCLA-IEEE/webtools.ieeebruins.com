<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Review Reimbursements - IEEE Webtools</title>
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
    <link rel='stylesheet' type='text/css' href='/public/css/form.css'  />
    <link rel='stylesheet' type='text/css' href='/public/css/review.css' />

    <!-- SCRIPTS -->
    <script src='/public/js/review.js'></script>
</head>
<body>
    <!-- NAVBAR -->
    <?php include('./views/includes/navbar.php'); ?>

    <div class="container" role="main">
        <h1 class="col-md-6 col-md-offset-3 page-header text-center">Review Process</h1>
        <div class="form col-md-6 col-md-offset-3">
            <form class="form webtools-form review-form">
                <div class="form-group">
                    <label for="id" class="control-label">Reimbursement ID #</label>
                    <input type="text" class="form-control" name="id" required>
                </div>
                <div class="form-group">
                    <label for="approve" class="control-label">Approved?</label>
                    <select name="approve" class="form-control">
                        <option value="1">Approved</option>
                        <option value="2">Denied</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fund" class="control-label">Fund?</label>
                    <select name="fund" class="form-control">
                        <option value="general">GENERAL</option>
                        <option value="class">CLASS</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="reimburse" class="control-label">Reimbursed?</label>
                    <select name="reimburse" class="form-control">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="check" class="control-label">Check #</label>
                    <input type="text" class="form-control" name="check">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary form-control">Submit</button>
                </div>
            </form>
            <p class='status-message'></p>

            <form class='nuke-form text-center'>
                <h1>Nukes</h1>
                <button type='submit' class='btn btn-primary form-control'>Nuke All Reimbursements and Receipts</button>
                <p class='nuke-message'></p>
            </form>
        </div>
    </div>
</body>
</html>
