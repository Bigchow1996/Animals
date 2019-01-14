<?php
header("content-type:text/html;charset=utf-8");
require_once '../functions/mysql.func.php';
require_once '../config/config.php';
require_once '../functions/common.func.php';
$link = connect3();

$table_knowledge = 'knowledge';

$table_say_knowledge = 'say_knowledge';

$id_knowledge = isset($_GET['id'])?$_GET['id']:"";

$id_say_knowledge = isset($_GET['say_id_knowledge'])?$_GET['say_id_knowledge']:"";

delete($link,$table_knowledge,"id =".$id_knowledge);

delete($link,$table_say_knowledge,"id =".$id_say_knowledge);