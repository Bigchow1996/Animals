<?php
session_start();
define('INCLUDE_CHECK',1);
require_once('connect.php');
require_once('function.php');
require_once 'functions/mysql.func.php';
require_once 'config/config.php';
header("content-type:text/html;charset=utf-8");
$link = connect3();
$knowledge_id = $_GET['id_knowledge']?$_GET['id_knowledge']:1;
$_SESSION['knowledgeid'] = $knowledge_id;
$page_say = $_GET['page_say']?$_GET['page_say']:1;
$pageSize = 5;
$offset_say = ($page_say - 1)*5;
$sql = "select * from say_knowledge where userid = {$knowledge_id}";
$result=mysql_query($sql);
$totalRows_say=mysql_num_rows($result);
$sumPage_say = ceil($totalRows_say/$pageSize);

$table_knowledge = "knowledge";

$query_knowledge = "select * from knowledge where id = {$knowledge_id}";

$rows_knowlege = fetchAll($link,$query_knowledge);

$query=mysql_query("select * from say_knowledge where userid = {$knowledge_id} order by id desc limit {$offset_say},{$pageSize}");
while ($row=mysql_fetch_array($query)) {
    $sayList.=formatSay($row[content],$row[addtime],$row[userid]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<title>详情</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/card.css"/>
    <link rel="stylesheet" href="css/main.css">
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="editor/kindeditor-min.js"></script>
    <script type="text/javascript">
	var editor;
    KindEditor.ready(function(K){
        editor = K.create("#tid",{
        	width:"100%",
        	resizeType : 1,  
        	items : [
         	 	    'print','cut', 'copy', 'paste',
         	 		'selectall', '|', 'fullscreen', '/',
         	 	],
         	 	autoSetDataMode : true,
         	 	cssPath : 'editor/plugins/code/prettify.css',
				uploadJson : 'editor/php/upload_json.php',
				fileManagerJson : 'editor/php/file_manager_json.php',
				allowFileManager : true,
				afterBlur : function(){this.sync();}
            });
        });
	</script>
	<style type="text/css">
		body{
			padding-top:0px;
			padding-bottom:0px;
		}
        .demo h3{height:32px; line-height:32px; font-size:18px ;}
        .demo h3 span{float:right; font-size:32px; font-family:Georgia,serif; color:#ccc; overflow:hidden}
        .input{width:100%; height:58px;  border:1px solid #aaa; font-size:12px; line-height:18px; overflow:hidden}
        .sub_btn{float:right; width:94px; height:28px;}
        .saylist{margin:8px auto; padding:4px 0; border-bottom:1px dotted #d3d3d3}
        .saylist img{float:left; width:50px; margin:4px}
        .saytxt{float:left; margin-top:5px; overflow:hidden}
        .saytxt p{line-height:18px}
        .saytxt p strong{margin-right:6px}
        .clear{clear:both}
        .date{color:#999}
        .inact,.inact:hover{background:#f5f5f5; border:1px solid #eee; color:#aaa; cursor:auto;}
        #msg{color:#f30}
	</style>
</head>
<body>
<div class="container">
<nav class="navbar navbar-default" role="navigation">
   <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" 
         data-target="#example-navbar-collapse">
         <span class="sr-only">切换导航</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">动物资料管理系统v1.0</a>
   </div>
   <div class="collapse navbar-collapse col-sm-10 " id="example-navbar-collapse">
      <ul class="nav navbar-nav" id="ul">
         <li><a href="database.php">数据列表</a></li>
         <li><a href="layout-form.php">新增数据</a></li>
         <li><a href="charts.php">数据可视化</a></li>
        
         <li><img id="userphoto" class="img-circle profile" src="<?php echo $_SESSION['pic_url'];?>"/></li>
    	 <div class="hovercard">
		    <div class="hovercontent">
				<div id='user' class='col-sm-12'>
					<div class='contact-box'>
							<div class='text-center'>
								<img class = 'img-circle' style="margin-top: 10px;" width='70px' height='70px' src='<?php echo $_SESSION['pic_url'];?>'>
							</div>
							<div class='col-sm-12'>
								<div class="col-sm-12" style="text-align: center;">
									<h3><strong><?php echo $_SESSION["name"];?></strong></h3>
								</div>
								<div class="col-sm-12"><span class='glyphicon glyphicon-dashboard'></span>上次登陆<?php echo $_SESSION["time"];?></div>
								<form action='uploadphoto.php' method='post' id='myform' target='userImg' enctype='multipart/form-data'>
									<a href='javascript:;' class='a-upload col-sm-6'>
										<input type='file' name='photo'>&nbsp;上传头像
									</a>
									<a href='loginout.php' class='a-upload col-sm-6'>
										<input type='button'/>&nbsp;退出登陆
									</a>
								</form>
								<iframe name='userImg' frameborder = '1' src='' style='display:none;'></iframe>
							</div>
						<div class='clearfix'></div>
					</div> 
				</div>      
			 </div>
    	 </div>
      </ul>
      <form class="navbar-form navbar-right" role="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">提交</button>
      </form>
   </div>
</nav>

	<div class="main">
		<div class="row">
			<!-- 右侧内容 -->
			<div class="col-md-12">
				<!-- 自定义内容 -->
				<div class="col-md-12">
				<!-- 自定义内容 -->
				<div class="panel panel-default">
					<div class="panel-heading">动物知识</div>
					<div class="panel-body">
						<table class="table table-striped table-bordered table-responsive table-hover">
							<tbody>
								<?php foreach ($rows_knowlege as $admin):?>
    								<tr>
    									<td width="50%">ID</td>
    									<td><?php echo $admin['id']?></td>
    								</tr>
    								<tr>
    									<td>标题</td>
    									<td><?php echo $admin['title']?></td>
    								</tr>
    								<tr>
    									<td>作者&来源</td>
    									<td><?php echo $admin['author']?></td>
    								</tr>
    								<tr>
    									<td>更新时间</td>
    									<td><?php echo $admin['time']?></td>
    								</tr>
    								<tr>
    									<td>新闻简介</td>
    									<td><?php echo $admin['jianjie']?></td>
    								</tr>
    								<tr>
    									<td colspan = "2"><textarea  name='info' class='form-control' disabled id='tid' rows='16'><?php echo $admin['document']?></textarea></td>
    								</tr>
    								    <a href="change_knowledge.php?id_knowledge=<?php  echo $admin['id'] ?>"><span>修改  </span></a>
								<?php endforeach;?>
							</tbody>
						</table>
					</div>
					<div class="demo col-md-12" style="margin-bottom:30px;">
                        <h3><span class="counter"></span>说说你的想法...</h3>
                        <div class="clear"></div>
                        <div id="saywrap">
                         <?php echo $sayList;?>
                        </div>
                        <nav>
        					<ul class="pagination pull-right">
        					<?php
        					   for($i = 1;$i<=$sumPage_say;$i++){
        					       echo "<li><a href='layout-detail-knowledge.php?page_say={$i}&knowledge_id={$knowledge_id}'>$i</a></li>";
        					   }echo "<li>第{$page_say}页<li>";
        					?>
        					</ul>
    				   </nav>
                   </div> 
				</div>
				<script>
            	  $(function(){
          		        $('#basic2').selectpicker({
            		        liveSearch: true,
            		        maxOptions: 1
            		    });
            		    $(".delect").click(function(){
            		        var id = $(this).attr("data_id");
            		        var url = "delect_data/delect_data.php?id="+id;
            		        $.get(url);
            		        $(this).parent().parent().parent().empty();
            			});
            		    $(".change").click(function(){
            		        var changeId = $(this).attr("data_id");
            		        var url = "change_data/change_data.php?changeId="+changeId;
            		        $.get(url);
            		    });
            		    $(':file').change(function(){
            	    	    $('#myform').submit();
            		    });
            		    var timeout;
            			$('.profile').hover(function() {
            	    		pos = $(this).offset();
            	    		timeout = setTimeout(function() {
            		        $('.hovercard').fadeIn().css({
            		            'top': pos.top - 40 + 'px',  
            		            'left': pos.left - 610 + 'px'
            		        });
            		        }, 100);  
            			}, function() {
            	    	clearTimeout(timeout);
            			});
            			$('.hovercard').mouseleave(function() {
            			    $('.hovercard').fadeOut();
            			});
            	  });
             </script>	
			</div>
		</div>
  	</div>
</div>
<!-- 尾部 -->
<div class="jumbotron" style=" margin-bottom:0;margin-top:8.4%;">
	<div class="container" style="text-align: center">
	<span>Copyright&nbsp;©&nbsp;2017&nbsp;hainananimals.com,All rights reserved.<a href = "http://www.miitbeian.gov.cn">琼ICP备17001532号</a></span>
	</div>
</div>
</body>
</html>
