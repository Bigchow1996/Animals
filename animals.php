<?php
session_start();
require_once 'functions/mysql.func.php';
require_once 'config/config.php';
header("content-type:text/html;charset=utf-8");
$link = connect3();
$page_animals = $_GET['page_animals']?$_GET['page_animals']:1; 
$pageSize = 7;
$offset_animals = ($page_animals - 1)*7;
$table_animals = "animals";
$totalRows_animals = getTotalRows($link,$table_animals);
$sumPage_animals = ceil($totalRows_animals/$pageSize);
$query_animals = "select * from animals order by id desc limit {$offset_animals},{$pageSize}";
$rows_animals = fetchAll($link,$query_animals);
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <!-- 使用IE浏览器兼容模式 通过最新的ie版本渲染效果渲染当前的html页面-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- 是否可以进行缩放 主要是给移动端看的 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>海南动物资料网</title>
    <!-- 导入图标 -->
    <link rel="shortcut icon" href="./favicon.ico" />	
    <!-- banner header header-top introduction font_logo data cd-top footer-->
	<link rel="stylesheet" type="text/css" href="css/cd-top.css"/>
	<link rel="stylesheet" type="text/css" href="css/footer.css"/>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/article.css">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- jquery -->
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <!-- 必须在jquery之后 -->
    <script src="js/bootstrap.min.js"></script>
    <!--
    	选择注释
    	如果小于ie9的话就加载下面两个bootstrap
    -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
		body{
			padding-top:0px;
			padding-bottom:0px;
		}
	</style>
  </head>
  <body>
  	<div class="header">
  			<div class="logo">	
				<img alt="" src="images/logo.png">								
			</div>
			<div class="container"><!-- 这里类名不能乱改 因为是用的bootstrape框架-->
				<div class="top-menu col-md-9 col-md-push-1">
						<span class="menu"><img src="images/menu.png" alt=""></span>
					 	<ul class="nav1 ">
							<li><a href="index.html">首页</a></li>
							<li class="active"><a href="animals.php">动物</a></li>
							<li><a href="document.php">资料</a></li>
							<li><a href="index.html#about">交流</a></li>
							<li><a href="index.html#contact">关于</a></li>
					 	</ul>
				</div>
				<script>
				 $( "span.menu" ).click(function() {
				 $( "ul.nav1" ).slideToggle(400);
				 // 当屏幕处于移动端小平显示的时候，我点击菜单图标，就会显示下拉菜单.
				 });
				</script>
				<div class="search col-md-2">					
					<form action="Search.php" method="post">
						<input type="text" value="" name="search" placeholder="Search...">
						<input type="submit" value="">
					</form>					
				</div>
				<div class="reg col-md-1">
					&nbsp;<a href="reg.html" target="_blank"><span class="glyphicon glyphicon-user"></span>管理员</a>
				</div>
				<div class="clearfix"></div>	
				 <!-- clearfix是bootstrape特有的清除浮动的类
				 	使其在超小的屏幕上进行显示
				 -->
			</div>
		</div>
        <div class="banner">
            <img class="img-responsive" src="images/动物.jpg">
        </div>
		<div class="container">
            <ul class="bread-crumb">
                <li><a href="index.html">首页 Home</a></li>
                <li class="current">全部动物All Species</li>
            </ul>
            <div class="col-md-3 left-wrap">
                <div class="nav">
				    <div class="title"><h3>动物<br>Animals</h3></div>
				    <ul style="width:148px;height:400px;background:#767C88;padding:8px 0px 1px 0px;">
		                <li><a href="animals_sub.php?type=哺乳类">哺乳动物<br>Mammal</a></li>
		                <li><a href="animals_sub.php?type=鸟类">鸟类<br>Birds</a></li>
		                <li><a href="animals_sub.php?type=鱼类">鱼类<br>Fish</a></li>
		                <li><a href="animals_sub.php?type=两栖类">两栖动物<br>Amphibians</a></li>
		                <li><a href="animals_sub.php?type=爬行类">爬行动物<br>Reptile</a></li>
		                <li><a href="animals_sub_1.php?type_1=节肢类&type_2=甲壳类&type_3=软体类&type_4=原生类">无脊椎动物<br>Invertebrates</a></li>
		                <li><a href="animals.php">全部动物<br>All species</a></li>
		            </ul>
                </div>
				<ul class="recommend">
				    <li><a href="" target="_blank"><img class="loading-v1" alt="绿之叶公益" src="images/资料_.jpg" ></a></li>
				</ul>
            </div>
            <div class="col-md-9 right-wrap">
                <div class="r-t col-md-12">
                                                                全部动物 All species                        
                </div>
                <ul class="info-list">
                    <?php foreach ($rows_animals as $admin):?>
                    <li class="clearfix">
                        <div class=" col-md-4">
		                    <a href="animals_detail.php?animals_id=<?php echo $admin[id];?>" target="_blank"><?php echo $admin['pic_url']?></a>
		                </div>
                        <div class="text-wrap col-md-7" style="margin:0;">
                            <h3 class="clearfix" style="margin-top:5px;"><a href="animals_detail.php?animals_id=<?php echo $admin['id'];?>" target="_blank"><?php echo $admin['animalname']?>&nbsp;<?php echo $admin['englishname']?></a></h3>
                            <div style="width:100%;"><p style="margin: 0px"><?php echo $admin['jianjie']?></p></div>
                        </div>
                    </li>
                    <?php endforeach;?>
                </ul>
                <nav>
					<ul class="pagination pull-right">
					<?php
					   for($i = 1;$i<=$sumPage_animals;$i++){
					       echo "<li><a href='animals.php?page_animals={$i}'>$i</a></li>";
					   }echo "<li>第{$page_animals}页</li>";
					?>
					</ul>
			   </nav>
            </div>
    	</div>	  
<!-- /Contact Section -->
<!-- Footer Section -->
<section class="our-contacts slideanim" id="contact" style="background-color: #222; color: white;"><br><br><br>
	<p style="text-align:center;font-size: 2.5em;font-weight: 500;">关于我们</p><hr>
	<div class="container">
		<div class="row">
			<div class="col-md-4 footer-left">
				<h4 style="font-weight: 500; ">联系信息</h4>
				<div class="contact-info">
					<div class="address" style="font-family: '迷你简中等线';">	
						<i class="glyphicon glyphicon-globe"></i>
						<p class="p3">海南师范大学</p>
						<p class="p4">桂林洋校区</p>
					</div>
					<div class="phone">
						<i class="glyphicon glyphicon-phone-alt"></i>
						<p class="p3">15708997715</p>
						<p class="p4">15289831731</p>
					</div>
					<div class="email-info">
						<i class="glyphicon glyphicon-envelope"></i>
						<p class="p3">2287668894@qq.com</p>
						<p class="p3">1365003673@qq.com</p>
						<p class="p3">1643577750@qq.com</p>
					</div>
				</div>
			</div><!-- col -->
			<div class="col-md-4 footer-center" >
				<h4>通讯</h4>
				<p style="font-family: '迷你简中等线';">注册我们的通讯，及时为您发送我们内容的更新提示</p>
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<label for="inputEmail1" class="col-lg-4 control-label"></label>
						<div class="col-lg-10">
							<input type="email" class="form-control" id="inputEmail1" placeholder="邮箱" required>
						</div>
					</div>
					<div class="form-group">
						<label for="text1" class="col-lg-4 control-label"></label>
						<div class="col-lg-10">
							<input type="text" class="form-control" id="text1" placeholder="你的名字" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-10">
							<button type="submit" class="btn-outline" >登陆</button>
						</div>
					</div>
				</form><!-- form -->
			</div><!-- col -->
			<div class="col-md-4 footer-right">
				<h4>支持我们</h4>
				<p style="font-family: '迷你简中等线';">海南省动物网站，为您提供大量丰富的动物资源，帮助您更加了解海南省的动物信息，也欢迎您的支持，让我们一起分享海南省奇妙的动物世界</p>
				
			</div><!-- col -->
		</div><!-- row -->
	</div><!-- container -->
	<hr>
	<p style="margin: 0;background-color: #222;text-shadow:5px 5px 5px rgba(255,255,255,0.5);background-size:width:100%;height: 60px;text-align: center;line-height:55px;font-size:1em;color: white">
         Copyright&nbsp;©&nbsp;2017&nbsp;hainananimals.com,All rights reserved.<a href = "http://www.miitbeian.gov.cn">琼ICP备17001532号</a>
        </p>
</section>
<!-- /Footer Section -->
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