<?php
	$r_id = $_GET["r_id"];
	$phone = $_GET["phone"];

	error_reporting(E_ALL ^ E_DEPRECATED);
	$link=mysql_connect("localhost","root","JYwyq1996");
 	mysql_select_db("lottery_draw_system",$link);
 	mysql_query("set names utf8");

 	$sql="select * from record natural join award where r_id = $r_id";
 	$res=mysql_query($sql,$link);
 	$row = mysql_fetch_array($res);
 	$aname = $row["award_name"];
 	if($row["status"]=='new'){
 		$sql="update record set status = 'done' where r_id = $r_id;";
	 	mysql_query($sql);
		mysql_close($link);
		echo "充值成功,您为号码为 $phone 的手机号成功充值了 $aname";
 	}
 	else{
 		mysql_close($link);
 		echo "充值失败";
 	}
 	
?>