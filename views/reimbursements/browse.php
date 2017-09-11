<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Browse Reimbursements - IEEE Webtools</title>
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
    <script src='/public/js/browse.js'></script>
</head>
<body>
    <!-- NAVBAR -->
    <?php include('./views/includes/navbar.php'); ?>

    <h1 class="page-header text-center">Browse Reimbursements</h1>
    <div class="form text-center">
        <form class="form-inline webtools-form approval-filter">
            <div class="form-group form-group-lg">
                <label for="filter">Filter by approval attribute:</label>
                <select name="filter" id="filter" class="form-control">
                    <option value="approved">Approved</option>
                    <option value="denied">Denied</option>
                    <option value="pending" selected>Pending</option>
                    <option value="all">All</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class='table table-striped col-md-12'>
            <thead>
                <tr>
                    <th>ID#</th><th>Name</th><th>Reason</th><th>Amount</th><th>Phone / Email / Venmo</th>
                    <th>Approval</th><th>Receipt</th><th>Fund</th><th>Time Submitted</th><th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($reimbursements as $reimbursement) {
                    print '<tr>';
                    foreach ($reimbursement as $key => $value) {
                        print '<td>' . $value . '</td>';
                    }
                    print '</tr>';
                }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
