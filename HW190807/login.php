<?php 
session_start();
require_once("config.php");
$link = mysqli_connect($dbhost, $dbuser, $dbpass) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db($link, $dbname);
$hint="";

if (isset($_POST["btnOK"]))
{
    $user = $_POST["txtUserName"];
    $sqlcommand = "select * from costmer where cID='$user'";
    $result = mysqli_query($link,$sqlcommand);
    $row = mysqli_fetch_assoc($result);
    $_SESSION["cID"] = $row["cID"];
    $_SESSION["cPW"] = $row["cPW"];
    if ($_POST["txtUserName"] == "" or $_POST["txtPassword"] == "")//判斷帳號密碼是否空白
    {
    $hint ="帳號或密碼輸入空白";
    }
    else
    {
        if ( $_POST["txtUserName"] == $_SESSION["cID"] && $_POST["txtPassword"] == $_SESSION["cPW"] )//判斷帳號密碼是否輸入錯誤
        {
        header("Location:index.php");
        exit();
        }
        else {
        $hint ="帳號或密碼輸入錯誤";
        }
    }
}
if (isset($_POST["btnHome"]))
{
  header("Location:index.php");
}
if (isset($_GET["signout"]))
{
  unset($_SESSION["cID"]);
  header("Location:index.php");
  exit();
}
if (isset($_POST["btnjoin"]))
{
  header("Location:join.php");
}
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>shopping - Login</title>
</head>
<body>
<form id="form1" name="form1" method="post" action="">
  <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
    <tr>
      <td colspan="2" align="center" bgcolor="#CCCCCC"><font color="#FFFFFF">會員系統 - 登入</font></td>
    </tr>
    <tr>
      <td width="80" align="center" valign="baseline">帳號</td>
      <td valign="baseline"><input type="text" name="txtUserName" id="txtUserName" /></td>
    </tr>
    <tr>
      <td width="80" align="center" valign="baseline">密碼</td>
      <td valign="baseline"><input type="password" name="txtPassword" id="txtPassword" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="#CCCCCC">
      <input type="submit" name="btnOK" id="btnOK" value="登入" />
      <input type="reset" name="btnReset" id="btnReset" value="重設" />
      <input type="submit" name="btnHome" id="btnHome" value="回首頁" />
      <input type="submit" name="btnjoin" id="btnjoin" value="加入會員" />
      </td>
    </tr>
  </table>
</form>
        <h4 style="color:red;" align="center" ><?= $hint ?></h4>
</body>
</html>