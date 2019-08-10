<?php
session_start();
require_once("config.php");
$link = mysqli_connect($dbhost, $dbuser, $dbpass) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db($link, $dbname);
//匯入產品資料表
if (! isset ( $_GET ["id"] ))
{
    header("Location:index.php");
}
$id = $_GET ["id"];
$sqlcommand = "select * from product where pID='$id'";
$result = mysqli_query($link,$sqlcommand);
$row = mysqli_fetch_assoc($result);
if (!$_SESSION["cID"]) //判斷使用者是否有登入
{
    header("Location:index.php");
}
$hint="";
if (isset($_POST["amountOK"]))
{
    if ($_POST["amount"] == "")//判斷數量是否空白
    {
    $hint ="請輸入購買數量";
    }
    else {
        if ($_POST["amount"] <=0)//判斷數量是否大於零
        {
        $hint ="購買數量不可以小於零";
        }
        else //將購買項目寫入資料庫
        {
        $quantity =$_POST["amount"] ;
        $total = $row["price"] * $_POST["amount"];
        $sqlcommand3 = "INSERT INTO cart(cID,pID,pName,price,quantity,total)
        VALUES ('{$_SESSION['cID']}','{$row['pID']}','{$row['pName']}','{$row['price']}','{$quantity}','{$total }') ";
        $result3 = mysqli_query($link,$sqlcommand3);
        $hint ="共：". $total."元";
        }  
    }
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
<body align="center">
    <form id="form1" name="form1" method="post" action="">
    <img src="img/<?php echo $row["pic"]?>" width="100px" height="100px">
    <p>單價：<?= $row["price"] ?>
    <br>
    <p>數量：
    <input type="text" name="amount" id="amount" /></p>
    <br>
    <input type="submit" name="amountOK" id="amountOK" value="加入購物車" />
    <input type="reset" name="btnReset" id="btnReset" value="重填" />
    </form>
    <h4 style="color:red;" align="center" ><?= $hint ?></h4>
    <a href="index.php">回首頁</a>
    <a href="index.php">去結帳</a>
</body>
</html>