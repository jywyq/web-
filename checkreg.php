<?php 
	$name = $_GET["name"];
	$pwd = $_GET["pwd"];
	$repwd = $_GET["repwd"];
	$add = $_GET["add"];

	error_reporting(E_ALL ^ E_DEPRECATED);
	$link=mysql_connect("localhost","root","JYwyq1996");
 	mysql_select_db("lottery_draw_system",$link);
 	mysql_query("set names utf8");

	$reg_url = "registration.html";
	$login_url = "index.html";
	if($pwd != $repwd){
		echo "密码错误 登录失败";
		echo "<meta http-equiv=refresh content='0; url=$reg_url '>"; 
	}
	$sql = "insert into users(uid,name,address,left_chance,passward) values(null, '$name', '$add', 2, '$pwd');";
 	mysql_query($sql);

 	$sql="select * from users where name = '$name'";
 	//echo "sql: $sql<br>";
    $res=mysql_query($sql,$link);
 	$row=mysql_fetch_array($res);
 	$uid = $row["uid"];
	echo "<script type='text/javascript'>alert('注册成功 您的id为$uid  密码为$pwd');</script>";

 	mysql_close($link);
 	echo "<meta http-equiv=refresh content='0; url=$login_url '>"; 
?>