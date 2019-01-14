<?php
session_start();
header("content-type:text/html;charset=utf-8");
$con=mysqli_connect("localhost","root","root","admin");
mysqli_query($con, "set names utf8");
// 检测连接
if (mysqli_connect_errno())
{
    echo "连接失败: " . mysqli_connect_error();
}
$case = isset($_POST['case'])?$_POST['case']:"";
$id_session = $_SESSION['proid'];
switch ($case)
{
    case 1:
        $id = isset($_POST['change_id'])?$_POST['change_id']:"1";
        $query = "update protection set id = {$id} where id = {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 2:
        $name = isset($_POST['name'])?$_POST['name']:"1";
        $query = "update protection set name = '{$name}' where id =  {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 3:
        $addr = isset($_POST['addr'])?$_POST['addr']:"1";
        $query = "update protection set addr = '{$addr}' where id = {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 4:
        $jianjie = isset($_POST['jianjie'])?$_POST['jianjie']:"1";
        $query = "update protection set jianjie = '{$jianjie}' where id = {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 5:
        $document = isset($_POST['info'])?$_POST['info']:"2";
        $query = "update protection set document = '{$document}' where id = {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
}






