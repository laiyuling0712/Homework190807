<?php 
session_start();
require_once("config.php");
$link = mysqli_connect($dbhost, $dbuser, $dbpass) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db($link, $dbname);
$Guest="Guest";
if (isset($_SESSION["cID"]))
{
    //匯入使用者資料
    $user = $_SESSION["cID"];
    $sqlcommand = "select * from costmer where cID='$user'";
    $result = mysqli_query($link,$sqlcommand);
    $row = mysqli_fetch_assoc($result);
    $Guest = $row["cName"];
}
else
{
    $user="";
}
//匯入產品資料
$sqlcommand2 = "select * from product";//
$result2 = mysqli_query($link,$sqlcommand2);

//匯入使用者購買產品資料
$sqlcommand3 = "select * from cart where cID='$user'";//
$result3 = mysqli_query($link,$sqlcommand3);
//刪除購買產品
if (isset($_POST["btndelete"]))
{   
    header("Location:index.php");
    $sqlcommand4 = "DELETE FROM cart where cID='$user'";
    $result4 = mysqli_query($link,$sqlcommand4);
    $row4 = mysqli_fetch_assoc($result4);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>shopping</title>
</head>
<body>
    <table border="1" height="100%" width="100%">
        <tr  align="center" >
            <td width="200px" height="80px"><img src="img/logo.jpg" width="100px" height="80px"></td>
            <td>Banner</td>
            <td width="100px" height="80px">
            <?php if ($user == "") { ?>  
            <a href="login.php">登入</a> 
            <?php } else { ?>
            <a href="login.php?signout=1">登出</a>
            <?php }
            ?><br>
            歡迎! <?= $Guest ?>
            </td>
        </tr>
        <tr  height="80px" width="80px">  
            <td align="center"><img src="img/bag.jpg" height="80px"></td>
            <td rowspan="3" colspan="3">
            <ul data-role="listview" data-filter="true">
	        <?php while ($row2 = mysqli_fetch_assoc($result2)) : ?>
		    <li>
		    <h4><a href="shopping.php?id=<?php echo $row2["pID"] ?>"> 
			<img src="img/<?php echo $row2["pic"]?>" width="100px" height="100px">
			名稱：<?php echo $row2["pName"] ?> 單價：<?= $row2["price"] ?>  </h4>
			</span>
		    </a>
		    </li>
	        <?php endwhile ?>
	</ul>
            </td>
        </tr>
        <tr>
        <td rowspan="2" >

        您購買了：<br>
        <?php while ($row3 = mysqli_fetch_assoc($result3)) :  ?>
        
            產品：<?= $row3["pName"]  ?><br>
            單價：<?= $row3["price"]  ?><br>
            數量：<?= $row3["quantity"]  ?><br>
            金額：<?= $row3["total"]  ?><br>
        <?php endwhile ?>
        <form id="form1" name="form1" method="post" action="">
        <input type="submit" name="btndelete" id="btndelete" value="取消購買" />
        </FORM>
        </td>
        
        </tr>
        <tr>
            
        </tr>
    </table>
</body>
</html>