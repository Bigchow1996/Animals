<?php
header("content-type:text/html;charset=utf-8");
require_once '../functions/mysql.func.php';
require_once '../config/config.php';
require_once '../functions/common.func.php';
$link = connect3();
$table = 'information';

$name = isset($_POST['name'])?$_POST['name']:" ";
$mail = isset($_POST['mail'])?$_POST['mail']:" ";
$photo = isset($_POST['photo'])?$_POST['photo']:" ";
$advice = isset($_POST['info'])?$_POST['info']:" ";

$data = compact('name','mail','photo','advice');
$res = insert($link, $data, $table);
