<?php
header("content-type:text/html;charset=utf-8");
require_once '../functions/mysql.func.php';
require_once '../config/config.php';
require_once '../functions/common.func.php';
$link = connect3();

$table_news = 'news';

$table_say = 'say';


$id_news = isset($_GET['id'])?$_GET['id']:"";

$id_say_news = isset($_GET['say_id'])?$_GET['say_id']:"";

delete($link,$table_news,"id =".$id_news);

delete($link,$table_say,"id =".$id_say_news);
