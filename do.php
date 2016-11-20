<?php
	$aid = $_GET["aid"];
	$uid = $_GET["uid"];

	error_reporting(E_ALL ^ E_DEPRECATED);
	$link=mysql_connect("localhost","root","JYwyq1996");
 	mysql_select_db("lottery_draw_system",$link);
 	mysql_query("set names utf8");
 	
 	date_default_timezone_set('PRC');

 	$date = date("Y-m-d H:i:s",time());
 	$sql="insert into record(R_ID,UID,AID,TIME,STATUS) values(null,$uid,$aid,'$date','new');";
 	mysql_query($sql);
 	$sql="update users set left_chance=left_chance-1 where uid = $uid;";
 	mysql_query($sql);
 	
	mysql_close($link);
	echo "OK";
?>