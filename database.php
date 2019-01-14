<?php
require_once 'acl.inc.php';
session_start();

require_once 'functions/mysql.func.php';
require_once 'config/config.php';
header("content-type:text/html;charset=utf-8");
$link = connect3();

$page = $_GET['page']?$_GET['page']:1;
$page_ = $_GET['page_']?$_GET['page_']:1;
$page_news = $_GET['page_news']?$_GET['page_news']:1; 
$page_knowledge = $_GET['page_knowledge']?$_GET['page_knowledge']:1;
$page_pro = $_GET['page_pro']?$_GET['page_pro']:1;

$pageSize = 8;

$offset = ($page - 1)*8;
$offset_ = ($page_ - 1)*8;
$offset_news = ($page_news - 1)*8;
$offset_knowledge = ($page_knowledge - 1)*8;
$offset_pro = ($page_pro - 1)*8;

$table = "animals";
$table_ = "text";
$table_news = "news";
$table_knowledge = "knowledge";
$table_pro = "protection";

$totalRows = getTotalRows($link,$table);
$totalRows_ = getTotalRows($link,$table_);
$totalRows_news = getTotalRows($link,$table_news);
$totalRows_knowledge = getTotalRows($link,$table_knowledge);
$totalRows_pro = getTotalRows($link,$table_pro);

$sumPage = ceil($totalRows/$pageSize);
$sumPage_ = ceil($totalRows_/$pageSize);
$sumPage_news = ceil($totalRows_news/$pageSize);
$sumPage_knowledge = ceil($totalRows_knowledge/$pageSize);
$sumPage_pro = ceil($totalRows_pro/$pageSize);

$query = "select * from animals order by id desc limit {$offset},{$pageSize}";
$query_ = "select * from text order by id desc limit {$offset_},{$pageSize}";
$query_news = "select * from news order by id desc limit {$offset_news},{$pageSize}";
$query_knowledge = "select * from knowledge order by id desc limit {$offset_knowledge},{$pageSize}";
$query_pro = "select * from protection order by id desc limit {$offset_pro},{$pageSize}";
$rows = fetchAll($link,$query);
$rows_ = fetchAll($link,$query_);
$rows_news = fetchAll($link,$query_news);
$rows_knowledge = fetchAll($link,$query_knowledge);
$rows_pro = fetchAll($link,$query_pro);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>后台</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/bootstrap-select.css">
    <link rel="stylesheet" type="text/css" href="css/cd-top.css"/>
    <link rel="stylesheet" type="text/css" href="css/card.css"/>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="dist/js/bootstrap-select.js"></script>
    <script type="text/javascript" charset="utf-8" src="editor/kindeditor-min.js"></script> 	
</head>
<body>
<div class="container">
     <nav class="navbar navbar-default" role="navigation">
       <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
             <span class="sr-only">切换导航</span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">动物资料管理系统v1.0</a>
       </div>
       <div class="collapse navbar-collapse col-sm-10 " id="example-navbar-collapse">
          <ul class="nav navbar-nav" id="ul">
             <li  class="active"><a href="database.php">数据列表</a></li>
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
			<div class="col-md-12">
				<!-- 自定义内容 -->
				<div class="panel panel-default">
					<div class="panel-heading">动物列表</div>
					<div class="panel-body">
						<table class="table table-striped table-responsive table-bordered table-hover">
							<thead>
								<tr>
									<th>id<span class="up glyphicon glyphicon-arrow-up" title="升序"></span></th>
									<th>名称</th>
									<th>类别</th>
									<th>门</th>
									<th>纲</th>
									<th>目</th>
									<th>科</th>
									<th>属</th>
									<th>种</th>
									<th>保护级别</th>
									<th width="120">操作</th>
								</tr>
							</thead>
							<tbody>
							     <?php if($rows){?>
							     <?php foreach ($rows as $admin):?>
							     <tr>
									<th><?php echo $admin['id']?></th>
									<th><?php echo $admin['animalname']?></th>
									<th><?php echo $admin['animaltype']?></th>
									<th><?php echo $admin['men']?></th>
									<th><?php echo $admin['gang']?></th>
									<th><?php echo $admin['mu']?></th>
									<th><?php echo $admin['ke']?></th>
									<th><?php echo $admin['shu']?></th>
									<th><?php echo $admin['zhong']?></th>
									<th><?php echo $admin['protect_grade']?></th>
									<td>
									   <a href="layout-detail-animals.php?id=<?php echo $admin['id']?>"><span>详情</span></a>
									   <a href="change_animals.php?id=<?php  echo $admin['id'] ?>"><span>修改  </span></a>
									   <a href="#"><span class='delect_1' data_id='<?php echo $admin['id'] ?>'>删除</span></a>
									</td>
								</tr>
							     <?php endforeach;?>
							     <?php }else{ ?>
							         <tr>
    							         <th>-</th>
    							         <th>-</th>
    							         <th>-</th>
    							         <th>-</th>
    							         <th>-</th>
    							         <th>-</th>
    							         <th>-</th>
    							         <th>-</th>
    							         <th>-</th>
    							         <th>-</th>
    							         <th width="120">-</th> 
							         </tr>
							    <?php }?>
							</tbody>
							<script>
                            	  $(function(){
                          		        $('#basic2').selectpicker({
                            		        liveSearch: true,
                            		        maxOptions: 1
                            		    });
                            		    $(".delect_1").click(function(){
                            		        var id = $(this).attr("data_id");
                            		        var msg = "您真的确定要删除吗？\n\n请确认！";
                            		        if (confirm(msg)==true){
                            		        	var url = "delect_data/delect_data.php?id="+id;
                                		        $.get(url);
                                		        $(this).parent().parent().parent().empty();
                            		        }else{
                            		        return false;
                            		        }
                            			});
                            		    $(".delect_2").click(function(){
                            		        var id = $(this).attr("data_id");
                            		        var msg = "您真的确定要删除吗？\n\n请确认！";
                            		        if (confirm(msg)==true){
                            		        	var url = "delect_data/delect_news.php?id="+id;
                                		        $.get(url);
                                		        $(this).parent().parent().parent().empty();
                            		        }else{
                            		        return false;
                            		        }
                            			});
                            		    $(".delect_3").click(function(){
                            		        var id = $(this).attr("data_id");
                            		        var msg = "您真的确定要删除吗？\n\n请确认！";
                            		        if (confirm(msg)==true){
                            		        	var url = "delect_data/delect_knowledge.php?id="+id;
                                		        $.get(url);
                                		        $(this).parent().parent().parent().empty();
                            		        }else{
                            		        return false;
                            		        }
                            			});
                            		    $(".delect_4").click(function(){
                            		        var id = $(this).attr("data_id");
                            		        var msg = "您真的确定要删除吗？\n\n请确认！";
                            		        if (confirm(msg)==true){
                            		        	var url = "delect_data/delect_pro.php?id="+id;
                                		        $.get(url);
                                		        $(this).parent().parent().parent().empty();
                            		        }else{
                            		        return false;
                            		        }
                            			});
                            		    $(".delect_4").click(function(){
                            		        var id = $(this).attr("data_id");
                            		        var msg = "您真的确定要删除吗？\n\n请确认！";
                            		        if (confirm(msg)==true){
                            		        	var url = "delect_data/delect_text.php?id="+id;
                                		        $.get(url);
                                		        $(this).parent().parent().parent().empty();
                            		        }else{
                            		        return false;
                            		        }
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
						</table>
					</div>
				</div>
				<nav>
					<ul class="pagination pull-right">
					<?php
					   for($i = 1;$i<=$sumPage;$i++){
					       echo "<li><a href='database.php?page={$i}'>$i</a></li>";
					   }echo "<li>第{$page}页<li>";
					?>
					</ul>
				</nav>
			</div>	
		</div>
		<div class="row">   
			<div class="col-md-12">
				<!-- 自定义内容 -->
				<div class="panel panel-default">
					<div class="panel-heading">动物论文</div>
					<div class="panel-body">
						<table class="table table-striped table-bordered table-responsive table-hover">
							<thead>
								<tr>
									<th>id<span class="up glyphicon glyphicon-arrow-up" title="升序"></span></th>
									<th>标题</th>
									<th>作者&来源</th>
									<th>更新时间</th>
									<th width="120">操作</th>
								</tr>
							</thead>
							<tbody>
								<?php if($rows_){?>
							    <?php foreach ($rows_ as $admin):?>
    					         <tr>
    						         <th><?php echo $admin['id']?></th>
    						         <th><?php echo $admin['title']?></th>
    						         <th><?php echo $admin['author']?></th>
    						         <th><?php echo $admin['time']?></th>
    						         <th width="120">
    						           <a href="layout-detail-text.php?id_text=<?php echo $admin['id']?>"><span>详情</span></a>
									   <a href="change_text.php?text_id=<?php  echo $admin['id'] ?>"><span>修改  </span></a>
									   <a href="#"><span class='delect_4' data_id='<?php echo $admin['id'] ?>'>删除</span></a>
									 </th>
    					         </tr>
    					         <?php endforeach;?>
							     <?php }else{ ?>
							         <tr>
    							         <th>-</th>
    							         <th>-</th>
    							         <th>-</th>
    							         <th>-</th>
    							         <th width="120">-</th> 
							         </tr>
							     <?php }?>
							</tbody>
						</table>
					</div>
				</div>

				<nav>
					<ul class="pagination pull-right">
					<?php
					   for($i = 1;$i<=$sumPage_;$i++){
					       echo "<li><a href='database.php?page_={$i}'>$i</a></li>";
					   }echo "<li>第{$page_}页<li>";
					?>
					</ul>
				</nav>
			</div>
		  </div>
		  <div class="row">
		      
			<div class="col-md-12">
				<!-- 自定义内容 -->
				<div class="panel panel-default">
					<div class="panel-heading">动物新闻</div>
					<div class="panel-body">
						<table class="table table-striped table-bordered table-responsive table-hover">
							<thead>
								<tr>
									<th>id<span class="up glyphicon glyphicon-arrow-up" title="升序"></span></th>
									<th>标题</th>
									<th>作者&来源</th>
									<th>更新时间</th>
									<th width="120">操作</th>
								</tr>
							</thead>
							<tbody>
								<?php if($rows_news){?>
							    <?php foreach ($rows_news as $admin):?>
    					         <tr>
    						         <th><?php echo $admin['id']?></th>
    						         <th><?php echo $admin['title']?></th>
    						         <th><?php echo $admin['author']?></th>
    						         <th><?php echo $admin['time']?></th>
    						         <th width="120">
    						           <a href="layout-detail-news.php?news_id=<?php echo $admin['id']?>"><span>详情</span></a>
									   <a href="change_news.php?news_id=<?php  echo $admin['id'] ?>"><span>修改  </span></a>
									   <a href="#"><span class='delect_2' data_id='<?php echo $admin['id'] ?>'>删除</span></a>
									 </th>
    					         </tr>
    					         <?php endforeach;?>
							     <?php }else{ ?>
							         <tr>
    							         <th>-</th>
    							         <th>-</th>
    							         <th>-</th>
    							         <th>-</th>
    							         <th width="120">-</th> 
							         </tr>
							    <?php }?>
							</tbody>
						</table>
					</div>
				</div>

				<nav>
					<ul class="pagination pull-right">
					<?php
					   for($i = 1;$i<=$sumPage_news;$i++){
					       echo "<li><a href='database.php?page_news={$i}'>$i</a></li>";
					   }echo "<li>第{$page_news}页<li>";
					?>
					</ul>
				</nav>
			</div>
		  </div>
		  <div class="row">
		      
			<div class="col-md-12">
				<!-- 自定义内容 -->
				<div class="panel panel-default">
					<div class="panel-heading">动物知识</div>
					<div class="panel-body">
						<table class="table table-striped table-bordered table-responsive table-hover">
							<thead>
								<tr>
									<th>id<span class="up glyphicon glyphicon-arrow-up" title="升序"></span></th>
									<th>标题</th>
									<th>作者&来源</th>
									<th>更新时间</th>
									<th width="120">操作</th>
								</tr>
							</thead>
							<tbody>
								<?php if($rows_knowledge){?>
							    <?php foreach ($rows_knowledge as $admin):?>
    					         <tr>
    						         <th><?php echo $admin['id']?></th>
    						         <th><?php echo $admin['title']?></th>
    						         <th><?php echo $admin['author']?></th>
    						         <th><?php echo $admin['time']?></th>
    						         <th width="120">
    						           <a href="layout-detail-knowledge.php?id_knowledge=<?php echo $admin['id']?>"><span>详情</span></a>
									   <a href="change_knowledge.php?id_knowledge=<?php  echo $admin['id'] ?>"><span>修改  </span></a>
									   <a href="#"><span class='delect_3' data_id='<?php echo $admin['id'] ?>'>删除</span></a>
									 </th>
    					         </tr>
    					         <?php endforeach;?>
							     <?php }else{ ?>
							         <tr>
    							         <th>-</th>
    							         <th>-</th>
    							         <th>-</th>
    							         <th>-</th>
    							         <th width="120">-</th> 
							         </tr>
							    <?php }?>
							</tbody>
						</table>
					</div>
				</div>

				<nav>
					<ul class="pagination pull-right">
					<?php
					   for($i = 1;$i<=$sumPage_knowledge;$i++){
					       echo "<li><a href='database.php?page_knowledge={$i}'>$i</a></li>";
					   }echo "<li>第{$page_knowledge}页<li>";
					?>
					</ul>
				</nav>
			</div>
			
			<div class="col-md-12">
				<!-- 自定义内容 -->
				<div class="panel panel-default">
					<div class="panel-heading">动物保护</div>
					<div class="panel-body">
						<table class="table table-striped table-bordered table-responsive table-hover">
							<thead>
								<tr>
									<th>id<span class="up glyphicon glyphicon-arrow-up" title="升序"></span></th>
									<th>名字</th>
									<th>地址</th>
									<th>更新时间</th>
									<th width="120">操作</th>
								</tr>
							</thead>
							<tbody>
								<?php if($rows_pro){?>
							    <?php foreach ($rows_pro as $admin):?>
    					         <tr>
    						         <th><?php echo $admin['id']?></th>
    						         <th><?php echo $admin['name']?></th>
    						         <th><?php echo $admin['addr']?></th>
    						         <th><?php echo $admin['time']?></th>
    						         <th width="120">
    						           <a href="layout-detail-pro.php?id_pro=<?php echo $admin['id']?>"><span>详情</span></a>
									   <a href="change_pro.php?id_pro=<?php  echo $admin['id'] ?>"><span>修改  </span></a>
									   <a href="#"><span class='delect_4' data_id='<?php echo $admin['id'] ?>'>删除</span></a>
									 </th>
    					         </tr>
    					         <?php endforeach;?>
							     <?php }else{ ?>
							         <tr>
    							         <th>-</th>
    							         <th>-</th>
    							         <th>-</th>
    							         <th>-</th>
    							         <th width="120">-</th> 
							         </tr>
							    <?php }?>
							</tbody>
						</table>
					</div>
				</div>

				<nav>
					<ul class="pagination pull-right">
					<?php
					   for($i = 1;$i<=$sumPage_pro;$i++){
					       echo "<li><a href='database.php?page_pro={$i}'>$i</a></li>";
					   }echo "<li>第{$page_pro}页<li>";
					?>
					</ul>
				</nav>
			</div>
		  </div>
  	</div>
</div>
<!-- 尾部 -->
<div class="jumbotron" style=" margin-bottom:0;margin-top:11.6%;">
	<div class="container" style="text-align: center">
	<span>Copyright&nbsp;©&nbsp;2017&nbsp;hainananimals.com,All rights reserved.<a href = "http://www.miitbeian.gov.cn">琼ICP备17001532号</a></span>
	</div>
</div>
<!-- Back To Top -->
	<a href="#0" class="cd-top">Top</a>
	<!-- /Back To Top -->
	<script type="text/javascript">
		jQuery(document).ready(function($){
			var offset = 300,
			offset_opacity = 1200,
			scroll_top_duration = 700,
			$back_to_top = $('.cd-top');
		$(window).scroll(function(){
			( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
			if( $(this).scrollTop() > offset_opacity ) { 
				$back_to_top.addClass('cd-fade-out');
			}
		});
		$back_to_top.on('click', function(event){
			event.preventDefault();
			$('body,html').animate({
				scrollTop: 0 ,
			 	}, scroll_top_duration
			);
			});
		});
	</script>
</body>
</html>