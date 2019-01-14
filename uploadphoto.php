<?php
    session_start();
    header("Content-Type:text/html;charset=utf-8");
    $dblink=mysql_connect("localhost","root","asd123") or die("数据库连接失败");
    mysql_query("set names utf8");
    mysql_select_db("animals");
    $table = 'user';
// 附件的存储位置、附件的名字
    $path = "user_img/";
    $file = $_FILES['photo']['name'];
    $ext = array_pop(explode('.',$file));
    $username = $_SESSION['username'];
// 拼接成该文件在服务器上的名称
    $pic_url = $path.$username.'.'.$ext;
    $inserturl = "update user set pic_url = '{$pic_url}' where username='{$username}'";
    mysql_query($inserturl);
    if($_FILES['photo']['error']>0) {
    echo "<script>alert('请先选择图片')</script>";
    die("出错了！请先选择好图片".$_FILES['photo']['error']); 
    }
    if(move_uploaded_file($_FILES['photo']['tmp_name'],$pic_url)){
        echo "<script> userphoto=top.document.getElementById('userphoto'); userphoto.src='{$pic_url}'</script>";   
    }else{
        //echo "<BR>"."Upload Failed!".$_FILES['photo']['error'];  
        echo "对不起，上传头像失败了！";
        header("refresh:2;url=database.php");
    }
?>