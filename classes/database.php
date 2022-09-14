<?php
// error_reporting(0);
date_default_timezone_set('Asia/Bangkok');
$host1 = "202.162.79.11";
$username1 = "binspaceadmin";
$password1 = "Codesing2108@!";
$database1 = "mineshop";
$mysqli1 = new mysqli($host1, $username1, $password1, $database1);
$agent = mysqli_query($mysqli1, "SELECT prefix, kbank , scb, status FROM table_agent WHERE domain = '$_SERVER[HTTP_HOST]'");
$license = mysqli_fetch_array($agent);

$host2 = "202.162.79.11";
$username2 = "binspaceadmin";
$password2 = "Codesing2108@!";
$database2 = $license['prefix'] . "_mineshop";
$mysqli2 = new mysqli($host2, $username2, $password2, $database2);

$setting = mysqli_query($mysqli2, "SELECT * FROM table_setting");
$setting = mysqli_fetch_array($setting);

