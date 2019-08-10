<?php
session_start();
require_once("config.php");
$link = mysqli_connect($dbhost, $dbuser, $dbpass) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db($link, $dbname);
//匯入產品資料表
$sqlcommand = "select * from product";
$result = mysqli_query($link,$sqlcommand);
$row = mysqli_fetch_assoc($result);
//匯入顧客資訊
if (!$_SESSION["cID"]) //判斷使用者是否有登入
{
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php

    ?>
</body>
</html>