<?php

$db_host = "localhost";
$db_username = "root";
$db_pass = "password";
$db_name = "mem";
mysql_connect("$db_host", "$db_username", "$db_pass") or die(mysql_error());
mysql_select_db("$db_name") or die("no database by that name");
?>