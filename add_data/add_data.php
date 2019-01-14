<?php
session_start();
header("content-type:text/html;charset=utf-8");
require_once '../functions/mysql.func.php';
require_once '../config/config.php';
require_once '../functions/common.func.php';
$link = connect3();
$table = 'animals';
$id = isset($_POST['up_id'])?$_POST['up_id']:"";
$query = "select * from animals where id = {$id}";
$get_id = fetchOne($link,$query);
if(!$get_id){
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
    
    $englishname = isset($_POST['englishname'])?$_POST['englishname']:" ";
    $xuename = isset($_POST['xuename'])?$_POST['xuename']:" ";
    $width = isset($_POST['width'])?$_POST['width']:" ";
    $height = isset($_POST['height'])?$_POST['height']:" ";
    $weight = isset($_POST['weight'])?$_POST['weight']:" ";
    $life = isset($_POST['life'])?$_POST['life']:" ";
    $food = isset($_POST['food'])?$_POST['food']:" ";
    $fanzhi = isset($_POST['fanzhi'])?$_POST['fanzhi']:" ";
    $xixing = isset($_POST['xixing'])?$_POST['xixing']:" ";
    $fenbu = isset($_POST['fenbu'])?$_POST['fenbu']:" ";
    
    $jianjie = isset($_POST['jianjie'])?$_POST['jianjie']:" ";
    $pic_url = isset($_POST['pic_url'])?$_POST['pic_url']:" ";
    $animalname = isset($_POST["animalname"])?$_POST["animalname"]:" ";
    $animaltype = isset($_POST["animaltype"])?$_POST["animaltype"]:" ";
    $men = isset($_POST["men"])?$_POST["men"]:" ";
    $gang = isset($_POST["gang"])?$_POST["gang"]:" ";
    $mu = isset($_POST["mu"])?$_POST["mu"]:" ";
    $ke = isset($_POST["ke"])?$_POST["ke"]:" ";
    $shu = isset($_POST["shu"])?$_POST["shu"]:" ";
    $zhong = isset($_POST["zhong"])?$_POST["zhong"]:" ";
    $protect_grade = isset($_POST["protect_grade"])?$_POST["protect_grade"]:" ";
    $document = isset($_POST["info"])?$_POST["info"]:" ";
    $data = compact('id','animalname','animaltype','protect_grade','document','men','gang','mu','ke','shu','zhong','pic_url','number','jianjie','englishname','xuename','width','height','weight','life','food','fanzhi','xixing','fenbu');
    $res = insert($link, $data, $table);
    if($res){
        echo "<script>alert('插入成功')</script>";
    }else{
        echo "<script>alert('插入失败 ')</script>";
    }
}else{
    echo "<script>alert('编号重复/编号为空/不符合规范')</script>";
}