<?php
header("content-type:text/html;charset=utf-8");
require_once '../functions/mysql.func.php';
require_once '../config/config.php';
require_once '../functions/common.func.php';
$link = connect3();


$table_pro = 'protection';

$table_say_pro = 'say_protection';

$id_pro = isset($_GET['id'])?$_GET['id']:"";

$id_say_pro = isset($_GET['say_id_pro'])?$_GET['say_id_pro']:"";

delete($link,$table_pro,"id =".$id_pro);

delete($link,$table_say_pro,"id =".$id_say_pro);