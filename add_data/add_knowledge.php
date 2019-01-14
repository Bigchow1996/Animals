<?php
header("content-type:text/html;charset=utf-8");
require_once '../functions/mysql.func.php';
require_once '../config/config.php';
require_once '../functions/common.func.php';
$link = connect3();
$table = 'knowledge';
$id = isset($_POST['up_id_knowledge'])?$_POST['up_id_knowledge']:"";
$query = "select * from knowledge where id = {$id}";
$get_id = fetchOne($link,$query);
if(!$get_id){
    $author = isset($_POST["author"])?$_POST["author"]:"";
    $title = isset($_POST["title"])?$_POST["title"]:"";
    $time = date('Y年m月d日 H:i:s');
    $jianjie = isset($_POST["jianjie"])?$_POST["jianjie"]:"";
    $document = isset($_POST["info3"])?$_POST["info3"]:"";
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