<?php
header("content-type:text/html;charset=utf-8");
require_once '../functions/mysql.func.php';
require_once '../config/config.php';
require_once '../functions/common.func.php';
$link = connect3();

$table = 'animals';

$table_say_animals = 'say_animals';

$id = isset($_GET['id'])?$_GET['id']:"";

$id_say_animals = isset($_GET['say_id_animals'])?$_GET['say_id_animals']:"";

delete($link,$table,"id =".$id);

delete($link,$table_say_animals,"id =".$id_say_animals);