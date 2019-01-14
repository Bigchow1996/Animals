<?php
header("content-type:text/html;charset=utf-8");
require_once '../functions/mysql.func.php';
require_once '../config/config.php';
require_once '../functions/common.func.php';
$link = connect3();


$table_ = 'text';

$table_say_text = 'say_text';

$id_ = isset($_GET['id'])?$_GET['id']:"";

$id_say_text = isset($_GET['say_id_text'])?$_GET['say_id_text']:"";

delete($link,$table_,"id =".$id_);

delete($link,$table_say_text,"id =".$id_say_text);