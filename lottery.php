<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>抽奖</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="css/kinerLottery.css">
</head>
<body>
    <!-- 代码部分begin -->
    <?php
        $uid = $_GET["uid"];
        error_reporting(E_ALL ^ E_DEPRECATED);
        $link=mysql_connect("localhost","root","JYwyq1996");
        mysql_select_db("lottery_draw_system",$link);
        mysql_query("set names utf8");

        $sql="select * from users where uid = " . $uid;
        $res=mysql_query($sql,$link);
        $row=mysql_fetch_array($res);
        $name = $row["name"];
        $left_chance = $row["left_chance"];
        //echo $left_chance;
        mysql_close($link);
    ?>
    <div class="left"> 
        ID：<?php echo $uid ?><br>
        用户名：<?php echo $name ?><br>
        剩余抽奖机会：<span id="times"><?php echo $left_chance ?></span><br>
        <span id = "Debug"></span>
    </div>
    <div class="right">
        <a href="getrecord.php?uid= <?php echo $uid?>">查看获奖记录</a>
    </div>
    <div id="box" class="box">
        <div class="outer KinerLottery KinerLotteryContent"><img src="./images/lanren.png"></div>
        <!-- 大转盘分为三种状态：活动未开始（no-start）、活动进行中(start)、活动结束(completed),可通过切换class进行切换状态，js会根据这3个class进行匹配状态 -->
        <div class="inner KinerLotteryBtn start"></div>
    </div>
    <script src="js/zepto.min.js"></script>
    <script src="js/kinerLottery.js"></script>
    <script>
        /**
         * 根据转盘旋转角度判断获得什么奖品
         * @param deg
         * @returns {*}
         */
        var left_chance = <?php echo $left_chance?>;
        var uid = <?php echo $uid?>;
        var whichAwardid = function(deg) {
            if ((deg > 330 && deg <= 360) || (deg > 0 && deg <= 30)) { //10M流量
                return 1;
            } else if ((deg > 30 && deg <= 90)) { //IPhone 7
                return 2;
            } else if (deg > 90 && deg <= 150) { //30M流量
                return 3;
            } else if (deg > 150 && deg <= 210) { //5元话费
                return 4;
            } else if (deg > 210 && deg <= 270) { //IPad mini 4
                return 5;
            } else if (deg > 270 && deg <= 330) { //20元话费
                return 6;
            }
        }

         function postprize(prize)
        {
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
                    document.getElementById("Debug").innerHTML=xmlhttp.responseText;
                }
            }
            
            xmlhttp.open("GET","do.php?aid="+whichAwardid(prize)+"&uid="+uid,true);
            xmlhttp.send();
        }


        var whichAward = function(deg) {
            if ((deg > 330 && deg <= 360) || (deg > 0 && deg <= 30)) { //10M流量
                return "三网通流量 10M";
            } else if ((deg > 30 && deg <= 90)) { //IPhone 7
                return "iPhone7";
            } else if (deg > 90 && deg <= 150) { //30M流量
                return "三网通流量 30M";
            } else if (deg > 150 && deg <= 210) { //5元话费
                return "话费5元";
            } else if (deg > 210 && deg <= 270) { //IPad mini 4
                return "ipad mini4";
            } else if (deg > 270 && deg <= 330) { //20元话费
                return "话费20元";
            }
        }
        var KinerLottery = new KinerLottery({
            rotateNum: 8, //转盘转动圈数
            body: "#box", //大转盘整体的选择符或zepto对象
            direction: 0, //0为顺时针转动,1为逆时针转动
            disabledHandler: function(key) {
                switch (key) {
                    case "noStart":
                        alert("活动尚未开始");
                        break;
                    case "completed":
                        alert("活动已结束");
                        break;
                }
            }, //禁止抽奖时回调
            
            clickCallback: function() {
                if(left_chance <= 0){
                    alert("您已经没有抽奖机会");
                    return;
                }
                //此处访问接口获取奖品
                function random() {
                    return Math.floor(Math.random() * 360);
                }
                var prize = random();
                document.getElementById("times").innerHTML=--left_chance;
                this.goKinerLottery(prize);
            }, //点击抽奖按钮,再次回调中实现访问后台获取抽奖结果,拿到抽奖结果后显示抽奖画面
            KinerLotteryHandler: function(deg) {
                alert("恭喜您获得:" + whichAward(deg));
                //希望在这里把参数prize传给后台。
                postprize(deg);
            } //抽奖结束回调
        });
    </script>
    <!-- 代码部分end -->
</body>
</html>
