<?
session_start();
require_once 'functions/mysql.func.php';
require_once 'config/config.php';
header("content-type:text/html;charset=utf-8");
$link = connect3();

$search = isset($_POST['search'])?$_POST['search']:"";
$query_animals = "select * from animals where animalname ='{$search}'";
$rows_animals = fetchAll($link,$query_animals);

?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
    <script src="js/echarts.min.js"></script>
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
            body{
            padding-top:0px;
            padding-bottom:0px;
            }
            .ban{
            width:100%;
            height:100%;
            rgba:rgba(52, 52, 52, 0.5);
            }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
    	   <img alt="" src="images/logo.png">
        </div>
    	<div class="container">
    	   <div class="top-menu col-md-9 col-md-push-1">
    			<span class="menu"><img src="images/menu.png" alt=""></span>
    			 	<ul class="nav1 ">
    					<li><a href="index.html">首页</a></li>
    					<li><a href="animals.php">动物</a></li>
    					<li><a href="document.php">资料</a></li>
    					<li><a href="#about">交流</a></li>
    					<li><a href="#contact">关于</a></li>
    			 	</ul>
    	   </div>
    	   <script>
    	 	$( "span.menu" ).click(function() {
    	 	    $( "ul.nav1" ).slideToggle(400);
            });
            </script>
            <div class="search col-md-2">
                <form action="Search.php" method="post">
                <input type="text" value="" name="search" placeholder="Search...">
                <input type="submit" value="">
                </form>
    		</div>
    		<div class="reg col-md-1">
    		  <a href="reg.html" target="_blank"><span class="glyphicon glyphicon-user"></span>管理员</a>
    		</div>
    		<div class="clearfix"></div>
    	</div>
	</div>
    <div class="banner">
        <img class="img-responsive" src="images/动物.jpg">
    </div>
	<div class="container">
        <ul class="bread-crumb">
            <li><a href="index.html">首页 Home</a></li>
            <li class="current">搜索结果</li>
        </ul>
        <div class="col-md-3 left-wrap">
			<ul class="recommend">
			    <li><a href="" target="_blank"><img class="loading-v1" alt="绿之叶公益" src="images/资料_.jpg" ></a></li>
			</ul>
        </div>
        <div class="col-md-9 right-wrap">
            <div class="r-t col-md-12">
                                                            全部结果                        
            </div>
            <ul class="info-list">
                <?php if($rows_animals){?>
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
                <?php }else{ ?>
			    <li class="clearfix">
                                            抱歉没有查询到与<span style="color: red;"><?php echo $search;?></span>相关的记录<br>您可以去百度一下哈
                </li>
				<?php }?>
            </ul>
        </div>
	</div>
    <section class="our-contacts slideanim" id="about" style="background-image: url(images/11.jpg);background-position: 100% 50% 50% 50%;background-attachment: fixed;background-size: cover;"><br><br><br>
	   <p style="text-align:center;font-size: 2.5em;">联系我们</p><br><br><br>
	   <div class="container">
    	   <div class="row">
        	   <div class="col-lg-12">
        	       <form onsubmit="return PostData()">
    					<div class="row">
					       <div class="form-group col-lg-4 slideanim">
					           <input type="text" name="name" class="form-control user-name" style="background-color: rgba(255,255,255,0.6);font-size: 1em;" placeholder="你的名字"  required/>
					       </div>
					       <div class="form-group col-lg-4 slideanim">
					           <input type="email" name="mail" class="form-control mail" style="background-color: rgba(255,255,255,0.6);font-size: 1em;"placeholder="你的邮箱" required/>
					       </div>
					       <div class="form-group col-lg-4 slideanim">
					           <input type="tel" name="photo" class="form-control pno" style="background-color: rgba(255,255,255,0.6);font-size: 1em;"placeholder="你的电话号码" required/>
					       </div>
					       <div class="clearfix"></div>
						   <div class="form-group col-lg-12 slideanim">
						       <textarea class="form-control" name="info" rows="6"style="background-color: rgba(255,255,255,0.5);font-size: 1em;" placeholder="你的意见" required/></textarea>
						    </div>
						    <div class="form-group col-lg-12 slideanim"><br><br>
							    <button type="submit" class="btn-outline1">提交</button><br><br><br>
						    </div>
						</div>
				    </form>
				    <script>
				    function PostData() {
						    $.ajax({
						        type: "POST",
						            url: "add_data/add_information.php",
						                data : "",
				            success: function(msg) {
				                alert('谢谢您的宝贵意见,但是我还是想让您加入我们↓↓↓↓');
					    }
					    });
					    return false;
				    }
				    </script>
			    </div>
		   </div>
	   </div>
    </section>
<!-- /Contact Section -->
<!-- Footer Section -->
<section class="our-contacts slideanim" id="contact" style="background-color: #222; color: white;"><br><br><br>
	<p style="text-align:center;font-size: 2.5em;font-weight: 500;">关于我们</p>
	<hr>
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