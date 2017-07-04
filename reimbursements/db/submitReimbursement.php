<?php

$hostName = file_get_contents('./hostName.txt'); // use localhost if on production
$dbUsername = file_get_contents('./dbUsername.txt');
$dbPassword = file_get_contents('./dbPassword.txt');

mysql_connect("localhost", $dbUsername, $dbPassword);

echo "dab";

// mysql_select_db('ieeebrui_tools');

?>
