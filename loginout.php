<?php
session_start();
//三部曲
session_unset();//第一步把当前的数组清空
session_destroy();//第二部删除服务器上的session文件
setcookie(session_name(),'',time()-3600,'/');//把客户端上的cookie删除
echo "<script>location = 'reg.html'</script>";
