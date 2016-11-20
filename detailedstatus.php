<!DOCTYPE html>
<html lang="en">
<head>
<?php
    $r_id = $_GET["r_id"];
    error_reporting(E_ALL ^ E_DEPRECATED);
    $link=mysql_connect("localhost","root","JYwyq1996");
    mysql_select_db("lottery_draw_system",$link);
    mysql_query("set names utf8");
    $sql="select * from record natural join award natural join users where r_id = $r_id";
    $res=mysql_query($sql,$link);
    $row=mysql_fetch_array($res);

    $uid = $row["uid"];
    $name = $row["name"];
    //echo "name $name<br>";
    $aid = $row["aid"];

?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="#" type="image/png">

    <title>充值界面</title>

    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet">
    <script src="js/zepto.min.js"></script>
    <script src="js/kinerLottery.js"></script>
<script>
    function posttt(){
        //alert("clc");
        var xmlhttp;
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("RRR").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","success.php?r_id=<?php echo $r_id?>&phone="+document.getElementById("XXX").value,true);
        xmlhttp.send();
        return false;
    }
</script>
</head>

<body class="login-body">


<div class="container">

    <form class="form-signin" action="#">
        <div class="form-signin-heading text-center">
            <h1 class="sign-title"></h1>
            <img src="images/login-logo.png" alt=""/>
        </div>
        <div class="login-wrap">
            <div class = 'mylable' id = 'RRR'>请输入希望充值的手机号。</div>
            <input id = "XXX" type="text" class="form-control" name = "phone" placeholder="您的手机号" autofocus>
            <input type="hidden" value="<?php echo $r_id?>"  name = "r_id">
            <button class="btn btn-lg btn-login btn-block" onclick="return posttt()">
                <i class="fa fa-check"></i>
            </button>
        </div>
    </form>
</div>



<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>

</body>
</html>
