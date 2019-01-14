<?php
define('INCLUDE_CHECK',1);
require_once('connect.php');
require_once('function.php');
session_start();
$txt=stripslashes($_POST['saytxt']);
$userid=$_SESSION['textid'];
$txt=mysql_real_escape_string(strip_tags($txt),$link); //过滤HTML标签，并转义特殊字符
if(mb_strlen($txt)<1 || mb_strlen($str)>140)
    die("0");
$time=time();
$query=mysql_query("insert into say_text(userid,content,addtime)values('$userid','$txt','$time')");
if(mysql_affected_rows($link)!=1)
    die("0");
echo formatSay($txt,$time,$userid);
?>
