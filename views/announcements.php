<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Announcements - IEEE Webtools</title>
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

    <div class="container" role="main">
        <h1>DEPRECATED PAGE. LET WEBMASTER KNOW IF THIS FEATURE SHOULD BE REVIVED</h1>
        <h1 class="col-md-6 col-md-offset-3 page-header">Announcements</h1>

        <div class="form col-md-6 col-md-offset-3">
            <div enctype="multipart/form-data" class="form">
                <div class="form-group">
                    <label for="content" class="control-label">New Announcement</label>
                    <textarea class="form-control" id="content" rows="5" cols="40" name="content"></textarea>
                </div>
                <button type="submit" class="btn btn-primary form-control">Submit</button>
            </div>

            <p><a href='#'>View Announcements</a></p>
        </div>
    </div>
</body>
</html>
