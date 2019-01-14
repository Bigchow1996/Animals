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
$id_session = $_SESSION['anid']; 
switch ($case)
{   
    case 0:
        $pic_url = isset($_POST['pic_url'])?$_POST['pic_url']:"1";
        $query = "update animals set pic_url = '{$pic_url}' where id = {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
       
    case 1:
        $id = isset($_POST['change_id'])?$_POST['change_id']:"1";
        $query = "update animals set id = {$id} where id = {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 2:
        $animalname = isset($_POST['animalname'])?$_POST['animalname']:"1";
        $query = "update animals set animalname = '{$animalname}' where id =  {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 2.1:
        $englishname = isset($_POST['englishname'])?$_POST['englishname']:"1";
        $query = "update animals set englishname = '{$englishname}' where id =  {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 2.11:
        $xuename = isset($_POST['xuename'])?$_POST['xuename']:"1";
        $query = "update animals set xuename = '{$xuename}' where id =  {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 2.12:
        $width = isset($_POST['width'])?$_POST['width']:"1";
        $query = "update animals set width = '{$width}' where id =  {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 2.13:
        $height = isset($_POST['height'])?$_POST['height']:"1";
        $query = "update animals set height = '{$height}' where id =  {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 2.14:
        $weight = isset($_POST['weight'])?$_POST['weight']:"1";
        $query = "update animals set weight = '{$weight}' where id =  {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 2.15:
        $life = isset($_POST['life'])?$_POST['life']:"1";
        $query = "update animals set life = '{$life}' where id =  {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 2.16:
        $food = isset($_POST['food'])?$_POST['food']:"1";
        $query = "update animals set food = '{$food}' where id =  {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 2.17:
        $fanzhi = isset($_POST['fanzhi'])?$_POST['fanzhi']:"1";
        $query = "update animals set fanzhi = '{$fanzhi}' where id =  {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 2.18:
        $xixing = isset($_POST['xixing'])?$_POST['xixing']:"1";
        $query = "update animals set xixing = '{$xixing}' where id =  {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 2.19:
        $fenbu = isset($_POST['fenbu'])?$_POST['fenbu']:"1";
        $query = "update animals set fenbu = '{$fenbu}' where id =  {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 2.5:
        $jianjie = isset($_POST['jianjie'])?$_POST['jianjie']:"1";
        $query = "update animals set jianjie = '{$jianjie}' where id =  {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 3:
        $animaltype = isset($_POST['animaltype'])?$_POST['animaltype']:"1";
        $query = "update animals set animaltype = '{$animaltype}' where id = {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 4:
        $men = isset($_POST['men'])?$_POST['men']:"1";
        $query = "update animals set men = '{$men}' where id = {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 5:
        $gang = isset($_POST['gang'])?$_POST['gang']:"2";
        $query = "update animals set gang = '{$gang}' where id = {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 6:
        $mu = isset($_POST['mu'])?$_POST['mu']:"2";
        $query = "update animals set mu = '{$mu}' where id = {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 7:
        $ke = isset($_POST['ke'])?$_POST['ke']:"2";
        $query = "update animals set ke = '{$ke}' where id = {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 8:
        $shu = isset($_POST['shu'])?$_POST['shu']:"2";
        $query = "update animals set shu = '{$shu}' where id = {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 9:
        $zhong = isset($_POST['zhong'])?$_POST['zhong']:"2";
        $query = "update animals set zhong = '{$zhong}' where id = {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 10:
        $protect_grade = isset($_POST['protect_grade'])?$_POST['protect_grade']:"2";
        $query = "update animals set protect_grade = '{$protect_grade}' where id = {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 11:
        $year1 = isset($_POST["year1"])?$_POST["year1"]:"";
        $year2 = isset($_POST["year2"])?$_POST["year2"]:"";
        $year3 = isset($_POST["year3"])?$_POST["year3"]:"";
        $year4 = isset($_POST["year4"])?$_POST["year4"]:"";
        $year5 = isset($_POST["year5"])?$_POST["year5"]:"";
        $year6 = isset($_POST["year6"])?$_POST["year6"]:"";
        $year7 = isset($_POST["year7"])?$_POST["year7"]:"";
        $year8 = isset($_POST["year8"])?$_POST["year8"]:"";
        $year9 = isset($_POST["year9"])?$_POST["year9"]:"";
        $year10 = isset($_POST["year10"])?$_POST["year10"]:"";
        $number1 = isset($_POST["number1"])?$_POST["number1"]:"";
        $number2 = isset($_POST["number2"])?$_POST["number2"]:"";
        $number3 = isset($_POST["number3"])?$_POST["number3"]:"";
        $number4 = isset($_POST["number4"])?$_POST["number4"]:"";
        $number5 = isset($_POST["number5"])?$_POST["number5"]:"";
        $number6 = isset($_POST["number6"])?$_POST["number6"]:"";
        $number7 = isset($_POST["number7"])?$_POST["number7"]:"";
        $number8 = isset($_POST["number8"])?$_POST["number8"]:"";
        $number9 = isset($_POST["number9"])?$_POST["number9"]:"";
        $number10 = isset($_POST["number10"])?$_POST["number10"]:"";
        
        $year_ = $year1.' '.$year2.' '.$year3.' '.$year4.' '.$year5.' '.$year6.' '.$year7.' '.$year8.' '.$year9.' '.$year10;
        $number_ = $number1.' '.$number2.' '.$number3.' '.$number4.' '.$number5.' '.$number6.' '.$number7.' '.$number8.' '.$number9.' '.$number10;
        $number = $year_.'-'.$number_;
        $query = "update animals set number = '{$number}' where id = {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
    case 12:
        $document = isset($_POST["info"])?$_POST["info"]:"";
        $query = "update animals set document = '{$document}' where id = {$id_session}";
        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('修改成功')</script>";
        }else{
            echo "<script>alert('修改失败')</script>";
        };
        break;
}