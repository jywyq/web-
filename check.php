<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php 
	$uid = $_GET["uid"];
	$passward = $_GET["passward"];

	error_reporting(E_ALL ^ E_DEPRECATED);
	$link=mysql_connect("localhost","root","JYwyq1996");
 	mysql_select_db("lottery_draw_system",$link);
 	mysql_query("set names utf8");
 	
	$sql="select * from users where uid = " . $uid;
	//echo "$sql<br>";
	$res=mysql_query($sql,$link);
	$truepwd = mysql_fetch_array($res)["passward"];

	//echo "true pwd $truepwd <br>";
	//echo "get pwd $passward <br>";

	$lottery_url="lottery.php";
	$login_url = "index.html";
	if($truepwd==$passward){
		echo "密码正确 正在跳转";
		echo "<meta http-equiv=refresh content='0; url=$lottery_url?uid=$uid '>"; 
	}else{
		echo "密码错误 登录失败";
		echo "<meta http-equiv=refresh content='0; url=$login_url '>"; 
	}

?>
</body>
</html>