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
</head>
<body>
    <!-- NAVBAR -->
    <?php include('./views/includes/navbar.php'); ?>

    <h1 class="page-header text-center">Browse Reimbursements</h1>
    <div class="form text-center">
        <form method="get" class="form-inline">
            <div class="form-group form-group-lg">
                <label for="filter">Filter by approval attribute:</label>
                <select name="filter" id="filter" class="form-control">
                    <option value="approved">Approved</option>
                    <option value="denied">Denied</option>
                    <option value="pending">Pending</option>
                    <option value="reimbursed">Reimbursed</option>
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
        </table>
        <?php
            $dbconnection = mysql_connect('localhost','ieeebrui_ieeeweb','SKCOR333i!');

            if(!$dbconnection) {
                die('Database connection failed. Please contact the webmaster. Begin trace: '.mysql_error());
            }

            $database = mysql_select_db('ieeebrui_tools',$dbconnection);

            if(!$database) {
                die('Database connection failed. Please contact the webmaster. Begin trace: '.mysql_error());
            }

            if (isset($_GET["filter"])) {

                $filterChoice = $_GET['filter'];

                if ($filterChoice == "approved") {
                    $query = "SELECT * FROM treasurer WHERE approve = 1 ORDER BY time DESC";
                } else if ($filterChoice == "denied") {
                    $query = "SELECT * FROM treasurer WHERE approve = 2 ORDER BY time DESC";
                } else if ($filterChoice == "pending") {
                    $query = "SELECT * FROM treasurer WHERE approve = 0 ORDER BY time ASC";
                } else if ($filterChoice == "reimbursed") {
                    $query ="SELECT * FROM treasurer WHERE approve = 1 && reimbursed = 1 ORDER BY time DESC";
                } else if ($filterChoice == "all") {
                    $query = "SELECT * FROM treasurer ORDER BY time DESC";
                } else {
                    die('Invalid approval attribute');
                }

                $result = mysql_query($query);

                if (!$result) {
                    echo "<p \>Oh no! Something broke :(. <p \> SQL DEBUG: ". mysql_error();
                    die();
                }

                echo "
                <tbody>";
                while ($row = mysql_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['name']."</td>";
                    echo "<td>".$row['reason']."</td>";
                    if ($row['amount'][0] != "$") {
                        echo "<td>$".$row['amount']."</td>";
                    } else {
                        echo "<td>".$row['amount']."</td>";
                    }
                    echo "<td>".$row['contact']."</td>";

                    if ($row['approve']==1) {
                        echo "<td>Approved</td>";
                    } else if ($row['approve']==2) {
                        echo "<td>Denied</td>";
                    } else {
                        echo "<td>Pending</td>";
                    }

                    echo "<td><a href=\"".$row['link']."\">Receipt</a></td>";
                    echo "<td>".$row['fund']."</td>";
                    echo "<td>".$row['time']."</td>";

                    echo "<td>";
                    if($row['reimbursed'] == 0) {
                        echo "No";
                    } else {
                     echo "Yes. <br/>Check # :".$row['check'];
                    }
                    echo "</td>";

                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                mysql_free_result($result);
            }
        ?>
    </div>
</body>
</html>
