<?php
header("content-type:text/html;charset=utf-8");
require_once '../functions/mysql.func.php';
require_once '../config/config.php';
require_once '../functions/common.func.php';
$link = connect3();
$table = 'text';
$id = isset($_POST['up_id_text'])?$_POST['up_id_text']:"";
$query = "select * from text where id = {$id}";
$get_id = fetchOne($link,$query);
if(!$get_id){
    $author = isset($_POST["author"])?$_POST["author"]:"";
    $title = isset($_POST["textName"])?$_POST["textName"]:"";
    $time = date('Y年m月d日 H:i:s');
    $jianjie = isset($_POST["jianjie"])?$_POST["jianjie"]:"";
    $document = isset($_POST["info1"])?$_POST["info1"]:"";
    $data = compact('id','author','title','time','document','jianjie');
    $res = insert($link, $data, $table);
    if($res){
        echo "<script>alert('插入成功')</script>";
    }else{
       echo "<script>alert('插入失败')</script>";
}
}else{
    echo "<script>alert('编号重复/编号为空/不符合规范')</script>";
}