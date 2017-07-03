<?php

$dbUsername = file_get_contents('./dbUsername.txt');
$dbPassword = file_get_contents('./dbPassword.txt');

echo $dbUsername;
echo $dbPassword;

?>
