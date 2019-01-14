<?php
session_start();
require_once 'acl.inc.php';
require_once 'functions/mysql.func.php';
require_once 'config/config.php';
header("content-type:text/html;charset=utf-8");
$link = connect3();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>添加数据</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/cd-top.css"/>
    <link rel="stylesheet" href="dist/css/bootstrap-select.css">
    <link rel="stylesheet" type="text/css" href="css/card.css"/>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="dist/js/bootstrap-select.js"></script>
    <script type="text/javascript" charset="utf-8" src="editor/kindeditor.js"></script>   

    <script>
        var editor;
        KindEditor.ready(function(K){
            editor = K.create("#tid",{
            	resizeType : 2, 
            	width:"100%", 
            	items : [
             	 		'undo', 'redo', '|', 'preview', 'print', 'template', 'cut', 'copy', 'paste',
             	 		'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
             	 		'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
             	 		'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
             	 		'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
             	 		'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
             	 		'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
             	 		'anchor', 'link', 'unlink'
             	 	],
             	 	cssPath : 'editor/plugins/code/prettify.css',
    				uploadJson : 'editor/php/upload_json.php',
    				fileManagerJson : 'editor/php/file_manager_json.php',
    				allowFileManager : true,
    				afterBlur : function(){this.sync();}
                });
            });
        var editor1;
        KindEditor.ready(function(K1){
            editor1 = K1.create("#tid1",{
            	resizeType : 1,  
            	width:"100%",
            	items : [
             	 		'undo', 'redo', '|', 'preview', 'print', 'template', 'cut', 'copy', 'paste',
             	 		'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
             	 		'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
             	 		'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
             	 		'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
             	 		'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
             	 		'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
             	 		'anchor', 'link', 'unlink'
             	 	],
             	 	cssPath : 'editor/plugins/code/prettify.css',
    				uploadJson : 'editor/php/upload_json.php',
    				fileManagerJson : 'editor/php/file_manager_json.php',
    				allowFileManager : true,
    				afterBlur : function(){this.sync();}
                });
            });
        var editor2;
        KindEditor.ready(function(K1){
            editor2 = K1.create("#tid2",{
            	resizeType : 1,  
            	width:"100%",
            	items : [
             	 		'undo', 'redo', '|', 'preview', 'print', 'template', 'cut', 'copy', 'paste',
             	 		'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
             	 		'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
             	 		'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
             	 		'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
             	 		'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
             	 		'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
             	 		'anchor', 'link', 'unlink'
             	 	],
             	 	cssPath : 'editor/plugins/code/prettify.css',
    				uploadJson : 'editor/php/upload_json.php',
    				fileManagerJson : 'editor/php/file_manager_json.php',
    				allowFileManager : true,
    				afterBlur : function(){this.sync();}
                });
            });
        var editor3;
        KindEditor.ready(function(K1){
            editor3 = K1.create("#tid3",{
            	resizeType : 1,  
            	width:"100%",
            	items : [
             	 		'undo', 'redo', '|', 'preview', 'print', 'template', 'cut', 'copy', 'paste',
             	 		'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
             	 		'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
             	 		'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
             	 		'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
             	 		'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
             	 		'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
             	 		'anchor', 'link', 'unlink'
             	 	],
             	 	cssPath : 'editor/plugins/code/prettify.css',
    				uploadJson : 'editor/php/upload_json.php',
    				fileManagerJson : 'editor/php/file_manager_json.php',
    				allowFileManager : true,
    				afterBlur : function(){this.sync();}
                });
            });
        var editor4;
        KindEditor.ready(function(K1){
            editor4 = K1.create("#tid4",{
            	resizeType : 1,  
            	width:"100%",
            	items : [
             	 		'undo', 'redo', '|', 'preview', 'print', 'template', 'cut', 'copy', 'paste',
             	 		'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
             	 		'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
             	 		'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
             	 		'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
             	 		'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
             	 		'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
             	 		'anchor', 'link', 'unlink'
             	 	],
             	 	cssPath : 'editor/plugins/code/prettify.css',
    				uploadJson : 'editor/php/upload_json.php',
    				fileManagerJson : 'editor/php/file_manager_json.php',
    				allowFileManager : true,
    				afterBlur : function(){this.sync();}
                });
            });
        var editor5;
        KindEditor.ready(function(K1){
            editor5 = K1.create("#tid5",{
            	resizeType : 1,  
            	width:"100%",
            	items : [
             	 	    'image'
             	 	],
             	 	cssPath : 'editor/plugins/code/prettify.css',
    				uploadJson : 'editor/php/upload_json.php',
    				fileManagerJson : 'editor/php/file_manager_json.php',
    				allowFileManager : true,
    				afterBlur : function(){this.sync();}
                });
            });
    </script> 
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
         <li class="active"><a href="layout-form.php">新增数据</a></li>
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
										<input type='file' id="user" name='photo'>&nbsp;上传头像
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
			<div class="col-md-12" >
				<!-- 错误提示 -->
				<div class="alert alert-danger" role="alert">
				    <h3>新增物种</h3>
					<ul>
					    <li>编号不能为空</li>
					    <li>名字不能重复</li>
					</ul>
				</div>
				<!-- 自定义内容 -->
				<div class="panel panel-default">
					<div class="panel-heading">新增物种</div>
					<div class="panel-body">
						<form action="add_data/add_data.php" method="post" target="animals" class="form-horizontal" enctype="multipart/form-data">
						    <div class="form-group">
								<label class="col-sm-1 control-label">照片</label>
								<div class="col-sm-9">
									<textarea  name="pic_url" class="form-control" id="tid5" rows="16"></textarea>
								</div>
							</div>
						    <div class="form-group">
								<label class="col-sm-1 control-label">编号</label>
								<div class="col-sm-9">
									<input type="text" name="up_id" class="form-control" placeholder="编号">
								</div>
								<div class="col-sm-2">
									<p class="form-control-static text-danger">编号不能为空</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label">中文名</label>
								<div class="col-sm-9">
									<input type="text" name="animalname" class="form-control" placeholder="名字">
								</div>
								<div class="col-sm-2">
									<p class="form-control-static text-danger">如胡兀鹫（hú wū jiù）</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label">英文名</label>
								<div class="col-sm-9">
									<input type="text" name="englishname" class="form-control" placeholder="名字">
								</div>
								<div class="col-sm-2">
									<p class="form-control-static text-danger">如Bearded vulture</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label">学名</label>
								<div class="col-sm-9">
									<input type="text" name="xuename" class="form-control" placeholder="名字">
								</div>
								<div class="col-sm-2">
									<p class="form-control-static text-danger">如Gypaetus barbatus</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label">体长:</label>
								<div class="col-sm-2">
									<input type="text" name="width" class="form-control" placeholder="95-125厘米">
								</div>
								<label class="col-sm-1 control-label">身高:</label>
								<div class="col-sm-2">
									<input type="text" name="height" class="form-control" placeholder="95-125厘米">
								</div>
								<label class="col-sm-1 control-label">体重:</label>
								<div class="col-sm-2">
									<input type="text" name="weight" class="form-control" placeholder="5-7公斤">
								</div>
								<label class="col-sm-1 control-label">生命:</label>
								<div class="col-sm-2">
									<input type="text" name="life" class="form-control" placeholder="10-15岁">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label">食性:</label>
								<div class="col-sm-2">
									<input type="text" name="food" class="form-control" placeholder="主要以裸骨为食">
								</div>
								<label class="col-sm-1 control-label">繁殖:</label>
								<div class="col-sm-2">
									<input type="text" name="fanzhi" class="form-control" placeholder="每窝产卵通常2枚">
								</div>
								<label class="col-sm-1 control-label">习性:</label>
								<div class="col-sm-2">
									<input type="text" name="xixing" class="form-control" placeholder="夜间活动">
								</div>
								<label class="col-sm-1 control-label">分布:</label>
								<div class="col-sm-2">
									<input type="text" name="fenbu" class="form-control" placeholder="亚洲、欧洲、非洲">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label">简介</label>
								<div class="col-sm-9">
									<input type="text" name="jianjie" class="form-control" placeholder="简介">
								</div>
								<div class="col-sm-2">
									<p class="form-control-static text-danger">简短一些就行了</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label">类别</label>
								<div class="col-sm-9">
									<label class="radio-inline">
										<input type="radio" name="animaltype" value="哺乳类">哺乳
									</label>
									<label class="radio-inline">
										<input type="radio" name="animaltype" value="原生类">原生
									</label>
									<label class="radio-inline">
										<input type="radio" name="animaltype" value="鸟类">鸟类
									</label>
									<label class="radio-inline">
										<input type="radio" name="animaltype" value="鱼类">鱼类
									</label>
									<label class="radio-inline">
										<input type="radio" name="animaltype" value="软体类">软体
									</label>
									<label class="radio-inline">
										<input type="radio" name="animaltype" value="甲壳类">甲壳
									</label>
									<label class="radio-inline">
										<input type="radio" name="animaltype" value="两栖类">两栖
									</label>
									<label class="radio-inline">
										<input type="radio" name="animaltype" value="节肢类">节肢
									</label>
									<label class="radio-inline">
										<input type="radio" name="animaltype" value="爬行类">爬行
									</label>
								</div>
								<div class="col-sm-2">
									<p class="form-control-static text-danger text-left">日常分类</p>
								</div>
							</div>
							<div class="form-group">
                              <label for="basic2" class="col-sm-1 control-label">门</label>
                              <div class="col-sm-9">
                                <select id="basic2" class="show-tick form-control" name="men" >
                                  <option>请选择</option>
                                  <option>1 多孔动物门 Porifera</option>
                                  <option>2 扁盘动物门 Placozoa</option>
                                  <option>3 单胚动物门 Monoblastozoa</option>
                        		  <option>4 凡德虫动物门 Vendobionta</option>
                                  <option>5 栉水母动物门 Ctenophora</option>
                                  <option>6 刺胞动物门 Cnidaria</option>
                                  <option>7 线虫动物门 Nematoda</option>
                                  <option>8 线形动物门 Nematomorpha</option>
                                  <option>9 鳃曳动物门 Priapulida</option>
                                  <option>10 铠甲动物门 Loricifera</option>
                                  <option>11 动吻动物门 Kinorhyncha</option>
                        		  <option>12  叶足动物门 Lobopodia</option>
                                  <option>13 有爪动物门 Onychophora</option>
                                  <option>14 缓步动物门 Tardigrada</option>
                                  <option>15 节肢动物门 Arthropoda</option>
                                  <option>16 扁形动物门 Platyhelminthes</option>
                                  <option>17 直泳虫门 Orthonectida</option>
                                  <option>18 菱形虫门 Rhombozoa</option>
                                  <option>19 腹毛动物门 Gastrotricha</option>
                        		  <option>20  苔藓动物门 Bryozoa</option>
                                  <option>21 环口动物门 Cycliophora</option>
                                  <option>22 内肛动物门 Entoprocta</option>
                                  <option>23 原腔动物门 Procoelomata</option>
                                  <option>24 轮虫动物门 Rotifera</option>
                                  <option>25 棘头动物门 Acanthocephala</option>
                                  <option>26 微颚动物门 Micrognathozoa</option>
                                  <option>27 颚胃动物门 Gnathostomulida</option>
                        		  <option>28  纽形动物门 Nemertea</option>
                                  <option>29 环节动物门 Annelida</option>
                                  <option>30 帚虫动物门 Phoronida</option>
                                  <option>31 腕足动物门 Brachiopoda</option>
                                  <option>32 软体动物门 Mollusca</option>
                                  <option>33 毛颚动物门 Chaetognatha</option>
                                  <option>34 无腔动物门 Acoelomorpha</option>
                                  <option>35 异涡动物门 Xenoturbellida</option>
                                  <option>36 古虫动物门 Vetulicolia</option>
                        		  <option>37  棘皮动物门 Echinodermata</option>
                                  <option>38 半索动物门 Hemichordata</option>
                                  <option>39 脊索动物门 Chordata</option>
                                </select>
                              </div>
                              <div class="col-sm-2">
    							  <p class="form-control-static text-danger text-left">如脊索动物门</p>
    						  </div>
                            </div>
                            <div class="form-group">
                              <label for="basic3" class="col-sm-1 control-label">纲</label>
                              <div class="col-sm-9">
                                <select id="basic3" class="show-tick form-control" name="gang" >
                                  <option>请选择</option>
                                  <option>1 石灰海绵纲 Class Calcarea</option>
                                  <option>2 六放海绵纲 Class Hexactinellida </option>
                                  <option>3 寻常海绵纲 Class Demospongiae</option>
                        		  <option>4  水螅虫纲 Class Hydrozoa</option>
                                  <option>5 钵水母纲 Class Scyphzoa</option>
                                  <option>6 珊瑚虫纲 Class Anthozoa</option>
                                  <option>7 涡虫纲 Class Turbellaria</option>
                                  <option>8 吸虫纲 Class Trematoda</option>
                                  <option>9 绦虫纲 Class Cestoda</option>
                                  <option>10 多毛纲 Class Polychaeta</option>
                                  <option>11 贫毛纲 Class Oligochaeta</option>
                        		  <option>12  蛭纲 Class Hirudinea</option>
                                  <option>13 腹足纲 Class Gastropoda</option>
                                  <option>14 双经纲 Class Amphineura</option>
                                  <option>15 斧足纲 Class Pelecypoda</option>
                                  <option>16 掘足纲 Class Scaphopoda</option>
                                  <option>17 头足纲 Class Cephalopoda</option>
                                  <option>18 甲壳纲 Class Crustacea</option>
                                  <option>19 倍足纲 Class Diplopoda</option>
                        		  <option>20  唇足纲 Class Chilopoda</option>
                                  <option>21 蛛型纲 Class Archnida</option>
                                  <option>22 六足纲 Class Hexapoda</option>
                                  <option>23 切口纲 Class Merostomata</option>
                                  <option>24 海星纲 Class Asteroidea</option>
                                  <option>25 蛇尾纲 Class Ophiuroidea</option>
                                  <option>26 海胆纲 Class Echinoidea</option>
                                  <option>27 海e纲 Class Holothuroidea</option>
                        		  <option>28  海百合纲 Class Crinoidea</option>
                                  <option>29 软骨鱼纲 Class Chondrichthyes</option>
                                  <option>30 硬骨鱼纲 Class Osteichthyes</option>
                                  <option>31 两生纲 Class Amphibia</option>
                                  <option>32 爬虫纲 Class Reptilia</option>
                                  <option>33 鸟纲 Class Aves</option>
                                  <option>34 哺乳纲 Class Mammalia</option>
                                </select>
                              </div>
                              <div class="col-sm-2">
    							  <p class="form-control-static text-danger text-left">如鸟纲</p>
    						  </div>
                            </div>
                            <div class="form-group">
                              <label for="basic4" class="col-sm-1 control-label">目</label>
                              <div class="col-sm-9">
                                <select id="basic4" class="show-tick form-control" name="mu" >
                                  <option>请选择</option>
                                  <option>1 等足目</option>
                                  <option>2 端足目</option>
                                  <option>3 磷虾目</option>
                        		  <option>4   口足目</option>
                                  <option>5 十足目</option>
                                  <option>6 直翅目</option>
                                  <option>7 半翅目</option>
                                  <option>8 同翅目</option>
                                  <option>9 鞘翅目</option>
                                  <option>10 鳞翅目</option>
                                  <option>11 膜翅目</option>
                        		  <option>12  双翅目</option>
                                  <option>13 鲨目</option>
                                  <option>14 鳐（魟）目</option>
                                  <option>15 银鲛目</option>
                                  <option>16 鲟形目</option>
                                  <option>17 鲱形目</option>
                                  <option>18 鲑形目</option>
                                  <option>19 鲤形目</option>
                        		  <option>20  鳗鲡目</option>
                                  <option>21 海龙目</option>
                                  <option>22 鲈形目</option>
                                  <option>23 鲽形目</option>
                                  <option>24 无足目</option>
                                  <option>25 有尾目</option>
                                  <option>26 无尾目</option>
                                  <option>27 龟鳖目</option>
                        		  <option>28  有鳞目</option>
                                  <option>29 鳄形目</option>
                                  <option>30 平胸总目</option>
                                  <option>31 企鹅总目</option>
                                  <option>32 突胸总目</option>
                                  <option>33 鹳形目</option>
                                  <option>34 鹈形目</option>
                                  <option>35 雁形目</option>
                        		  <option>36   隼形目</option>
                                  <option>37 鸡形目</option>
                                  <option>38 鹤形目</option>
                                  <option>39 鸽形目</option>
                                  <option>40 鹃形目</option>
                                  <option>41 鹦形目</option>
                                  <option>42 枭形目</option>
                                  <option>43 雨燕目</option>
                        		  <option>44   鸥形目</option>
                                  <option>45 雀形目</option>
                                  <option>46 食虫目</option>
                                  <option>47 翼手目</option>
                                  <option>48 鳞甲目</option>
                                  <option>49 灵长目</option>
                                  <option>50 兔形目</option>
                                  <option>51 啮齿目</option>
                        		  <option>52  鲸目</option>
                                  <option>53 食肉目</option>
                                  <option>54 鳍脚目</option>
                                  <option>55 奇蹄目</option>
                                  <option>56 偶蹄目</option>
                                  <option>57 长鼻目</option>
                                </select>
                              </div>
                              <div class="col-sm-2">
    							  <p class="form-control-static text-danger text-left">如雀形目</p>
    						  </div>
                            </div>
                            <div class="form-group">
                              <label for="basic5" class="col-sm-1 control-label">科</label>
                              <div class="col-sm-9">
                                <select id="basic5" class="show-tick form-control" name="ke" >
                                  <option>请选择</option>
                                  <option>1 懒猴科</option>
                                  <option>2 猴科</option>
                                  <option>3 儒艮科</option>
                        		  <option>4   海豚科</option>
                                  <option>5 淡水豚科</option>
                                  <option>6 象科</option>
                                  <option>7 长臂猿科</option>
                                  <option>8 马科</option>
                                  <option>9 鲮鲤科 </option>
                                  <option>10 犬科</option>
                                  <option>11 骆驼科</option>
                        		  <option>12  熊科</option>
                                  <option>13 鼷鹿科</option>
                                  <option>14 鹿科</option>
                                  <option>15 大熊猫科</option>
                                  <option>16 浣熊科</option>
                                  <option>17 鼬科</option>
                                  <option>18 牛科</option>
                                  <option>19 灵猫科</option>
                        		  <option>20  猫科</option>
                                  <option>21 兔科</option>
                                  <option>22 松鼠科</option>
                                  <option>23 河狸科</option>
                                  <option>24 鸊鷉科</option>
                                  <option>25 鹤科</option>
                                  <option>26 信天翁科</option>
                                  <option>27 鲣鸟科</option>
                        		  <option>28  秧鸡科</option>
                                  <option>29 军舰鸟科</option>
                                  <option>30 鹭科</option>
                                  <option>31 雉鸻科</option>
                                  <option>32 鹳科</option>
                                  <option>33 鹬科</option>
                                  <option>34 燕鸻科</option>
                                  <option>35 鹮科</option>
                        		  <option>36   鸥科</option>
                                  <option>37 鸭科</option>
                                  <option>38 沙鸡科</option>
                                  <option>39 鸠鸽科</option>
                                  <option>40 鹰科</option>
                                  <option>41 鹦鹉科</option>
                                  <option>42 杜鹃科</option>
                                  <option>43 雨燕科</option>
                        		  <option>44   隼科</option>
                                  <option>45 凤头雨燕科</option>
                                  <option>46 松鸡科</option>
                                  <option>47 咬鹃科</option>
                                  <option>48 蜂虎科</option>
                                  <option>49 雉科</option>
                                  <option>50 犀鸟科</option>
                                  <option>51 啄木鸟科</option>
                        		  <option>52  阔嘴鸟科</option>
                                  <option>53 八色鸫科</option>
                                  <option>54 龟科</option>
                                  <option>55 柱头虫科</option>
                                  <option>56 玉钩虫科</option>
                                  <option>57 陆龟科</option>
                                  <option>58 宝贝科</option>
                                  <option>59 海龟科</option>
                        		  <option>60   冠螺科</option>
                                  <option>61 珍珠贝科</option>
                                  <option>62 棱皮龟科</option>
                                  <option>63 砗磲科</option>
                                  <option>64 鳖科</option>
                                  <option>65 蚌科</option>
                                  <option>66 壁虎科</option>
                                  <option>67 鹦鹉螺科</option>
                        		  <option>68   鳄蜥科</option>
                                  <option>69 巨蜥科</option>
                                  <option>70 铗[虫八]科</option>
                                  <option>71 蛇目蟒科</option>
                                  <option>72 箭蜓科</option>
                                  <option>73 鼍科（短吻鳄科）</option>
                                  <option>74 缺翅虫科</option>
                                  <option>75 蝾螈科</option>
                        		  <option>76  蛩蠊科</option>
                                  <option>77 步甲科</option>
                                  <option>78 蛙科</option>
                                  <option>79 臂金龟科</option>
                                  <option>80 犀金龟科</option>
                                  <option>81 石首鱼科</option>
                                  <option>82 凤蝶科</option>
                                  <option>83 杜父鱼科</option>
                                  <option>84 海龙鱼科</option>
                                  <option>85 胭脂鱼科</option>
                        		  <option>86  绢蝶科</option>
                                  <option>87 鲤科</option>
                                  <option>88 柳珊瑚目红珊瑚科</option>
                                  <option>89 鳗鲡科</option>
                                  <option>90 鲑科</option>
                                  <option>91 鲟科</option>
                                  <option>92 匙吻鲟科</option>
                                  <option>93 文昌鱼科（鳃口科）</option>
                                </select>
                              </div>
                              <div class="col-sm-2">
    							  <p class="form-control-static text-danger text-left">如细尾鹩莺科</p>
    						  </div>
                            </div>
                            <div class="form-group">
								<label class="col-sm-1 control-label">属</label>
								<div class="col-sm-9">
									<input type="text" name="shu" class="form-control" placeholder="属">
								</div>
								<div class="col-sm-2">
									<p class="form-control-static text-danger"> 如细尾鹩莺属</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label">种</label>
								<div class="col-sm-9">
									<input type="text" name="zhong" class="form-control" placeholder="种">
								</div>
								<div class="col-sm-2">
									<p class="form-control-static text-danger"> 如红背细尾鹩莺</p>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-1 control-label text-left" style="padding-top:0px;">保护级别</label>
								<div class="col-sm-8">
									<input type="text" name="protect_grade" class="form-control" placeholder="保护级别">
								</div>
								<div class="col-sm-3">
									<p class="form-control-static text-danger">如国家一级保护动物</p>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-1 control-label text-left" style="padding-top:0px;">种群数量</label>
								<div class="col-sm-1">
									<input type="text" name="year1" class="form-control" placeholder="日期">
								</div>
								<div class="col-sm-1">
									<input type="text" name="year2" class="form-control" placeholder="日期">
								</div>
								<div class="col-sm-1">
									<input type="text" name="year3" class="form-control" placeholder="日期">
								</div>
								<div class="col-sm-1">
									<input type="text" name="year4" class="form-control" placeholder="日期">
								</div>
								<div class="col-sm-1">
									<input type="text" name="year5" class="form-control" placeholder="日期">
								</div>
								<div class="col-sm-1">
									<input type="text" name="year6" class="form-control" placeholder="日期">
								</div>
								<div class="col-sm-1">
									<input type="text" name="year7" class="form-control" placeholder="日期">
								</div>
								<div class="col-sm-1">
									<input type="text" name="year8" class="form-control" placeholder="日期">
								</div>
								<div class="col-sm-1">
									<input type="text" name="year9" class="form-control" placeholder="日期">
								</div>
								<div class="col-sm-1">
									<input type="text" name="year10" class="form-control" placeholder="日期">
								</div>
								<div class="col-sm-1 col-sm-offset-1">
									<input type="text" name="number1" class="form-control" placeholder="数字">
								</div>
								<div class="col-sm-1">
									<input type="text" name="number2" class="form-control" placeholder="数字">
								</div>
								<div class="col-sm-1">
									<input type="text" name="number3" class="form-control" placeholder="数字">
								</div>
								<div class="col-sm-1">
									<input type="text" name="number4" class="form-control" placeholder="数字">
								</div>
								<div class="col-sm-1">
									<input type="text" name="number5" class="form-control" placeholder="数字">
								</div>
								<div class="col-sm-1">
									<input type="text" name="number6" class="form-control" placeholder="数字">
								</div>
								<div class="col-sm-1">
									<input type="text" name="number7" class="form-control" placeholder="数字">
								</div>
								<div class="col-sm-1">
									<input type="text" name="number8" class="form-control" placeholder="数字">
								</div>
								<div class="col-sm-1">
									<input type="text" name="number9" class="form-control" placeholder="数字">
								</div>
								<div class="col-sm-1">
									<input type="text" name="number10" class="form-control" placeholder="数字">
								</div>
								<div class="col-sm-1">
									<p class="form-control-static text-danger">建议连续</p>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-1 control-label text-left" style="padding-top:0px;">正文输入</label>
								<div class="col-sm-10">
									<textarea  name="info" class="form-control" id="tid" rows="16"></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" id="submit" class="btn btn-primary">提交</button>
								</div>
							</div>
						</form>
						<iframe name='animals' frameborder = '1' src='' style='display:none;'></iframe>
					</div>
				</div>
				<!-- 自定义内容2 -->
				<div class="alert alert-danger" role="alert">
					<h3>动物论文</h3>
				</div>
                <div class="panel panel-default">
					<div class="panel-heading">动物论文</div>
					<div class="panel-body">
						<form action="add_data/add_text.php" method="post" target="text" class="form-horizontal" enctype="multipart/form-data">
						    <div class="form-group">
								<label class="col-sm-1 control-label">编号</label>
								<div class="col-sm-9">
									<input type="text" name="up_id_text" class="form-control" placeholder="编号">
								</div>
								<div class="col-sm-2">
									<p class="form-control-static text-danger">编号不能为空</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label">标题</label>
								<div class="col-sm-9">
									<input type="text" name="textName" class="form-control" placeholder="如海南岛动物生态地理单元">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label">开头简介</label>
								<div class="col-sm-9">
									<input type="text" name="jianjie" class="form-control" placeholder="开头第一段文字即可">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label">作者&来源</label>
								<div class="col-sm-9">
									<input type="text" name="author" class="form-control" placeholder="如徐龙辉">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label text-left" style="padding-top:0px;">正文输入</label>
								<div class="col-sm-10">
									<textarea  name="info1" class="form-control" id="tid1" rows="16"></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" id="submit" class="btn btn-primary">提交</button>
								</div>
							</div>
						</form>
						<iframe name='text' frameborder = '1' src='' style='display:none;'></iframe>
					</div>
				</div>
				<div class="alert alert-danger" role="alert">
					<h3>新闻报导</h3>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">新闻报导</div>
					<div class="panel-body">
						<form action="add_data/add_news.php" method="post" target="news" class="form-horizontal" enctype="multipart/form-data">
						    <div class="form-group">
								<label class="col-sm-1 control-label">编号</label>
								<div class="col-sm-9">
									<input type="text" name="up_id_news" class="form-control" placeholder="编号">
								</div>
								<div class="col-sm-2">
									<p class="form-control-static text-danger">编号不能为空</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label">标题</label>
								<div class="col-sm-9">
									<input type="text" name="newsName" class="form-control" placeholder="新闻的标题">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label">作者&来源</label>
								<div class="col-sm-9">
									<input type="text" name="author_news" class="form-control" placeholder="如新华社">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label">开头简介</label>
								<div class="col-sm-9">
									<input type="text" name="jianjie" class="form-control" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label text-left" style="padding-top:0px;">正文输入</label>
								<div class="col-sm-10">
									<textarea  name="info2" class="form-control" id="tid2" rows="16"></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" id="submit" class="btn btn-primary">提交</button>
								</div>
							</div>
						</form>
						<iframe name='news' frameborder = '1' src='' style='display:none;'></iframe>
					</div>
				</div>
				<div class="alert alert-danger" role="alert">
					<h3>动物知识</h3>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">动物知识</div>
					<div class="panel-body">
						<form action="add_data/add_knowledge.php" method="post" target='knowledge' class="form-horizontal" enctype="multipart/form-data">
						    <div class="form-group">
								<label class="col-sm-1 control-label">编号</label>
								<div class="col-sm-9">
									<input type="text" name="up_id_knowledge" class="form-control" placeholder="编号">
								</div>
								<div class="col-sm-2">
									<p class="form-control-static text-danger">编号不能为空</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label">标题</label>
								<div class="col-sm-9">
									<input type="text" name="title" class="form-control" placeholder="如常见的动物分类">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label">作者&来源</label>
								<div class="col-sm-9">
									<input type="text" name="author" class="form-control" placeholder="如百度百科">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label">简介</label>
								<div class="col-sm-9">
									<input type="text" name="jianjie" class="form-control" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label text-left" style="padding-top:0px;">正文输入</label>
								<div class="col-sm-10">
									<textarea  name="info3" class="form-control" id="tid3" rows="16"></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" id="submit" class="btn btn-primary">提交</button>
								</div>
							</div>
						</form>
						<iframe name='knowledge' frameborder = '1' src='' style='display:none;'></iframe>
					</div>
				</div>
				<div class="alert alert-danger" role="alert">
					<h3>动物保护</h3>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">动物保护</div>
					<div class="panel-body">
						<form action="add_data/add_pro.php" method="post" target='pro' class="form-horizontal" enctype="multipart/form-data">
						    <div class="form-group">
								<label class="col-sm-1 control-label">编号</label>
								<div class="col-sm-9">
									<input type="text" name="up_id_pro" class="form-control" placeholder="编号">
								</div>
								<div class="col-sm-2">
									<p class="form-control-static text-danger">编号不能为空</p>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label">名字</label>
								<div class="col-sm-9">
									<input type="text" name="name" class="form-control" placeholder="如国家森林">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label">地址</label>
								<div class="col-sm-9">
									<input type="text" name="addr" class="form-control" placeholder="具体地点">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label">简介</label>
								<div class="col-sm-9">
									<input type="text" name="jianjie" class="form-control" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-1 control-label text-left" style="padding-top:0px;">正文输入</label>
								<div class="col-sm-10">
									<textarea  name="info" class="form-control" id="tid4" rows="16"></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" id="submit" class="btn btn-primary">提交</button>
								</div>
							</div>
						</form>
						<iframe name='pro' frameborder = '1' src='' style='display:none;'></iframe>
					</div>
				</div>
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
	<script>
    	  $(function(){
  		        $('#basic2').selectpicker({
    		        liveSearch: true,
    		        maxOptions: 1
    		    });
		        $('#basic3').selectpicker({
	  		        liveSearch: true,
	  		        maxOptions: 1
	  		    });
		        $('#basic4').selectpicker({
	  		        liveSearch: true,
	  		        maxOptions: 1
	  		    });
		        $('#basic5').selectpicker({
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
    		    $('#user').change(function(){
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