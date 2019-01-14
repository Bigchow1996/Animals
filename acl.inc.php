<?php
session_start();

if($_SESSION['login']){
    
}else{
    echo "<script>alert('您不是管理员，请走开！')</script>";
    echo "<script>location.href = 'index.html'</script>";
}