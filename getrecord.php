<!DOCTYPE html>
<html>
<head>
	<title>获奖记录</title>
	<link rel="stylesheet" href="css/getrecord.css">
	<!-- Javascript goes in the document HEAD -->
	<script type="text/javascript">
	function altRows(id){
		if(document.getElementsByTagName){  
			
			var table = document.getElementById(id);  
			var rows = table.getElementsByTagName("tr"); 
			 
			for(i = 0; i < rows.length; i++){          
				if(i % 2 == 0){
					rows[i].className = "evenrowcolor";
				}else{
					rows[i].className = "oddrowcolor";
				}      
			}
		}
	}

	window.onload=function(){
		altRows('alternatecolor');
	}
	</script>
</head>
<body>
	<div class = "hd">获奖记录</div>
	<?php 
		$uid = $_GET["uid"];
		//echo "uid $uid";

	    error_reporting(E_ALL ^ E_DEPRECATED);
	    $link=mysql_connect("localhost","root","JYwyq1996");
	    mysql_select_db("lottery_draw_system",$link);
	    mysql_query("set names utf8");
	    $sql="select * from record natural join award natural join users where uid = $uid order by time" ;
	    $res=mysql_query($sql,$link);

	    echo '<table class="altrowstable" id="alternatecolor">';
		echo "<tr>
			<th>用户id</th>
			<th>用户名</th>
			<th>时间</th>
			<th>奖品</th>
			<th>奖品描述</th>
			<th>奖品状态</th>
			<th>详细情况</th>
			</tr>";
	    while($row = mysql_fetch_array($res)){
	    	echo"<tr>";
			echo"<td>".$row["uid"]."</td>";
			echo"<td>".$row["name"]."</td>";
			echo"<td>".$row["time"]."</td>";
			echo"<td>".$row["award_name"]."</td>";
			echo"<td>".$row["award_info"]."</td>";
			echo"<td>".$row["status"]."</td>";
			if($row["aid"]==1||$row["aid"]==3||$row["aid"]==4||$row["aid"]==6)
				echo"<td><a href = 'detailedstatus.php?r_id=".$row["r_id"]."' >领取</a></td>";
			else
				echo"<td><a href = 'https://www.apple.com/cn/' >领取</a></td>";
			echo"</tr>";
	    }
	?>
	<div>
        <a href="index.html" class = "down1">重新登录</a>
        <a href="lottery.php?uid=<?php echo $uid?>" class = "down2">返回抽奖界面</a>
    </div>
</body>
</html>