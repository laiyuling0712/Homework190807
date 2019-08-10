<?php 
require_once("config.php");
$link = mysqli_connect($dbhost, $dbuser, $dbpass) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db($link, $dbname);

if (isset($_POST["btnOK"]))
{
    $userID = $_POST["txtID"];
    $userPW = $_POST["txtPW"];
    $userName = $_POST["txtName"];
    $sqlcommand = "INSERT INTO costmer(cID,cName,cPW)
    VALUES ('{$userID}','{$userName}','{$userPW}') ";
    $result = mysqli_query($link,$sqlcommand);
    echo "會員加入成功";
}
if (isset($_POST["btnHome"]))
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
    <title>join us</title>
</head>
<body align="center">
    <h1 style="color:red;">加入會員</h1>
    <form id="form1" name="form1" method="post" action="">
    帳號*：<input type="text" name="txtID" id="txtID" /><br>
    <br>
    密碼*：<input type="password" name="txtPW" id="txtPW" /><br>
    <br>
    姓名*：<input type="text" name="txtName" id="txtName"/><br>
    <input type="submit" name="btnOK" id="btnOK" value="加入會員" />
    <input type="reset" name="btnReset" id="btnReset" value="重設" />
    <input type="submit" name="btnHome" id="btnHome" value="回首頁" />
    </form>
</body>
</html>