<?php
session_start();
//连接数据库
$dblink=mysql_connect("localhost","root","asd123") or die("数据库连接失败");

//设置字符串编码

mysql_query("set names utf8");

//选择数据库

mysql_select_db("animals");

//获取表单数据
$account=isset($_POST['username'])?$_POST['username']:'';

$pwd=isset($_POST['password'])?$_POST['password']:'';

//$pwd=md5($pwd); //本示例仅为测试，未考虑测安全方面， 可以对密码进行md5加密。

$sql="select * from user where username='{$account}'";  

$rs=mysql_query($sql); //执行sql查询

$row=mysql_fetch_array($rs);

if($row['id']){ // 用户存在；
   if($pwd===$row['password']){ //对密码进行判断。
    $_SESSION["name"]=$row['name'];
    $_SESSION["username"]=$row['username'];
    $_SESSION["time"]=$row['time']; 
    $_SESSION['login']=1;
    $_SESSION['pic_url']=$row['pic_url'];  
    date_default_timezone_set('Asia/Shanghai');//设置时区为东八区
    $time = date('Y年m月d日 H:i:s');
    $insertTime = "update user set time = '{$time}' where username='{$account}'";
    mysql_query($insertTime);
    echo "<script>location = 'database.php'</script>";
    }else {
        echo "<script>alert('密码错误')</script>";
        echo "<script>location = 'reg.html'</script>";
    }
}else{
    echo "<script>alert('账户不存在')</script>";
    echo "<script>location = 'reg.html'</script>";
}
?>  