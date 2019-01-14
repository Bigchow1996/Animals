<?php
session_start();
define('INCLUDE_CHECK',1);
require_once('connect.php');
require_once('function_.php');
require_once 'functions/mysql.func.php';
require_once 'config/config.php';
header("content-type:text/html;charset=utf-8");
$link = connect3();
$animals_id = $_GET['id']?$_GET['id']:1;
$_SESSION['anid'] = $animals_id;
$page_say = $_GET['page_say']?$_GET['page_say']:1;
$pageSize = 5;
$offset_say = ($page_say - 1)*5;
$sql = "select * from say_animals where userid = {$animals_id}";
$result=mysql_query($sql);
$totalRows_say=mysql_num_rows($result);
$sumPage_say = ceil($totalRows_say/$pageSize);
$table_animals = "animals";
$query_animals = "select * from animals where id = {$animals_id}";
$rows_animals = fetchAll($link,$query_animals);
$query = "select * from say_animals where userid = {$animals_id} order by id desc limit {$offset_say},{$pageSize}";
$rows_say = fetchAll($link,$query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>修改数据</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/bootstrap-select.css">
    <link rel="stylesheet" type="text/css" href="css/card.css"/>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="dist/js/bootstrap-select.js"></script>
    <script type="text/javascript" charset="utf-8" src="editor/kindeditor.js"></script>  
	<script type="text/javascript">
	var editor;
    KindEditor.ready(function(K){
        editor = K.create("#tid",{
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
        editor = K.create("#tid1",{
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
			       <div class='panel panel-default'>
        		    <div class='panel-heading'>修改数据(物种)</div>
            	    <div class='changeCon panel-body'>
            	       <form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form' enctype="multipart/form-data">
                           <div class='form-group'>
                    	       <label class='col-sm-1 control-label'>照片</label>
                    	       <input type="text" name="case" value="0" style="display: none">
                	           <div class='col-sm-9'>
                        	           <?php foreach ($rows_animals as $admin):?>
                        	           <textarea  name='pic_url' class='form-control' id='tid1' rows='16'><?php echo $admin['pic_url']?></textarea>
    				           </div>
    			               <div class='col-sm-2'>
        						 <button type='submit' class='btn btn-primary'>修改</button>
        					   </div>
    			           </div>
    			       </form>
            	       <form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form'>
                           <div class='form-group'>
                    	       <label class='col-sm-1 control-label'>编号</label>
                    	        <input type="text" name="case" value="1" style="display: none">
                	           <div class='col-sm-9'>
               		            <input type='text' name='change_id' value="<?php echo $admin['id']?>" class='form-control' placeholder='编号'>
    				           </div>
    			               <div class='col-sm-2'>
        						 <button type='submit' class='btn btn-primary'>修改</button>
        					   </div>
    			           </div>
    			       </form>
    			       <form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form'>
                           <div class='form-group'>
                    	      <label class='col-sm-1 control-label'>中文名</label>
                    	      <input type="text" name="case" value="2" style="display: none">
                    	      <div class='col-sm-9'>
                    		    <input type='text' name='animalname' value='<?php echo $admin['animalname']?>' class='form-control' >
    					      </div>
    				          <div class='col-sm-2'>
        						 <button type='submit' class='btn btn-primary'>修改</button>
        					   </div>
    			           </div>
    			        </form>
    			        <form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form'>
                           <div class='form-group'>
                    	      <label class='col-sm-1 control-label'>英文名</label>
                    	      <input type="text" name="case" value="2.1" style="display: none">
                    	      <div class='col-sm-9'>
                    		    <input type='text' name='englishname' value='<?php echo $admin['englishname']?>' class='form-control'>
    					      </div>
    				          <div class='col-sm-2'>
        						 <button type='submit' class='btn btn-primary'>修改</button>
        					   </div>
    			           </div>
    			        </form>
    			        <form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form'>
                           <div class='form-group'>
                    	      <label class='col-sm-1 control-label'>学名</label>
                    	      <input type="text" name="case" value="2.11" style="display: none">
                    	      <div class='col-sm-9'>
                    		    <input type='text' name='xuename' value='<?php echo $admin['xuename']?>' class='form-control'>
    					      </div>
    				          <div class='col-sm-2'>
        						 <button type='submit' class='btn btn-primary'>修改</button>
        					   </div>
    			           </div>
    			        </form>
    			        <form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form'>
                           <div class='form-group'>
                    	      <label class='col-sm-1 control-label'>身长</label>
                    	      <input type="text" name="case" value="2.12" style="display: none">
                    	      <div class='col-sm-9'>
                    		    <input type='text' name='width' value='<?php echo $admin['width']?>' class='form-control'>
    					      </div>
    				          <div class='col-sm-2'>
        						 <button type='submit' class='btn btn-primary'>修改</button>
        					   </div>
    			           </div>
    			        </form>
    			        <form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form'>
                           <div class='form-group'>
                    	      <label class='col-sm-1 control-label'>身高</label>
                    	      <input type="text" name="case" value="2.13" style="display: none">
                    	      <div class='col-sm-9'>
                    		    <input type='text' name='height' value='<?php echo $admin['height']?>' class='form-control'>
    					      </div>
    				          <div class='col-sm-2'>
        						 <button type='submit' class='btn btn-primary'>修改</button>
        					   </div>
    			           </div>
    			        </form>
    			        <form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form'>
                           <div class='form-group'>
                    	      <label class='col-sm-1 control-label'>体重</label>
                    	      <input type="text" name="case" value="2.14" style="display: none">
                    	      <div class='col-sm-9'>
                    		    <input type='text' name='weight' value='<?php echo $admin['weight']?>' class='form-control'>
    					      </div>
    				          <div class='col-sm-2'>
        						 <button type='submit' class='btn btn-primary'>修改</button>
        					   </div>
    			           </div>
    			        </form>
    			        <form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form'>
                           <div class='form-group'>
                    	      <label class='col-sm-1 control-label'>生命</label>
                    	      <input type="text" name="case" value="2.15" style="display: none">
                    	      <div class='col-sm-9'>
                    		    <input type='text' name='life' value='<?php echo $admin['life']?>' class='form-control'>
    					      </div>
    				          <div class='col-sm-2'>
        						 <button type='submit' class='btn btn-primary'>修改</button>
        					   </div>
    			           </div>
    			        </form>
    			        <form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form'>
                           <div class='form-group'>
                    	      <label class='col-sm-1 control-label'>食性</label>
                    	      <input type="text" name="case" value="2.16" style="display: none">
                    	      <div class='col-sm-9'>
                    		    <input type='text' name='food' value='<?php echo $admin['food']?>' class='form-control'>
    					      </div>
    				          <div class='col-sm-2'>
        						 <button type='submit' class='btn btn-primary'>修改</button>
        					   </div>
    			           </div>
    			        </form>
    			        <form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form'>
                           <div class='form-group'>
                    	      <label class='col-sm-1 control-label'>繁殖</label>
                    	      <input type="text" name="case" value="2.17" style="display: none">
                    	      <div class='col-sm-9'>
                    		    <input type='text' name='fanzhi' value='<?php echo $admin['fanzhi']?>' class='form-control'>
    					      </div>
    				          <div class='col-sm-2'>
        						 <button type='submit' class='btn btn-primary'>修改</button>
        					   </div>
    			           </div>
    			        </form>
    			        <form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form'>
                           <div class='form-group'>
                    	      <label class='col-sm-1 control-label'>习性</label>
                    	      <input type="text" name="case" value="2.18" style="display: none">
                    	      <div class='col-sm-9'>
                    		    <input type='text' name='xixing' value='<?php echo $admin['xixing']?>' class='form-control'>
    					      </div>
    				          <div class='col-sm-2'>
        						 <button type='submit' class='btn btn-primary'>修改</button>
        					   </div>
    			           </div>
    			        </form>
    			        <form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form'>
                           <div class='form-group'>
                    	      <label class='col-sm-1 control-label'>分布</label>
                    	      <input type="text" name="case" value="2.19" style="display: none">
                    	      <div class='col-sm-9'>
                    		    <input type='text' name='fenbu' value='<?php echo $admin['fenbu']?>' class='form-control'>
    					      </div>
    				          <div class='col-sm-2'>
        						 <button type='submit' class='btn btn-primary'>修改</button>
        					   </div>
    			           </div>
    			        </form>
    			        <form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form'>
                           <div class='form-group'>
                    	      <label class='col-sm-1 control-label'>简介</label>
                    	      <input type="text" name="case" value="2.5" style="display: none">
                    	      <div class='col-sm-9'>
                    		    <input type='text' name='jianjie' value='<?php echo $admin['jianjie']?>' class='form-control'>
    					      </div>
    				          <div class='col-sm-2'>
        						 <button type='submit' class='btn btn-primary'>修改</button>
        					   </div>
    			           </div>
    			        </form>
    			        <form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form'>
    					   <div class="form-group">
								<label class="col-sm-1 control-label">类别</label>
								<input type="text" name="case" value="3" style="display: none">
								<div class="col-sm-9">
									<label class="radio-inline">
										<input type="radio" <?php if($admin['animaltype'] == '哺乳类'){ echo 'checked';}?> name="animaltype" value="哺乳类">哺乳
									</label>
									<label class="radio-inline">
										<input type="radio" <?php if($admin['animaltype'] == '原生类'){ echo 'checked';}?> name="animaltype" value="原生类">原生
									</label>
									<label class="radio-inline">
										<input type="radio" <?php if($admin['animaltype'] == '鸟类'){ echo 'checked';}?> name="animaltype" value="鸟类">鸟类
									</label>
									<label class="radio-inline">
										<input type="radio" <?php if($admin['animaltype'] == '鱼类'){ echo 'checked';}?> name="animaltype" value="鱼类">鱼类
									</label>
									<label class="radio-inline">
										<input type="radio" <?php if($admin['animaltype'] == '软体类'){ echo 'checked';}?> name="animaltype" value="软体类">软体
									</label>
									<label class="radio-inline">
										<input type="radio" <?php if($admin['animaltype'] == '甲壳类'){ echo 'checked';}?> name="animaltype" value="甲壳类">甲壳
									</label>
									<label class="radio-inline">
										<input type="radio" <?php if($admin['animaltype'] == '两栖类'){ echo 'checked';}?> name="animaltype" value="两栖类">两栖
									</label>
									<label class="radio-inline">
										<input type="radio" <?php if($admin['animaltype'] == '节肢类'){ echo 'checked';}?> name="animaltype" value="节肢类">节肢
									</label>
									<label class="radio-inline">
										<input type="radio" <?php if($admin['animaltype'] == '爬行类'){ echo 'checked';}?> name="animaltype" value="爬行类">爬行
									</label>
								</div>
								<div class="col-sm-2">
									<button type='submit' class='btn btn-primary'>修改</button>
								</div>
							</div>
						</form>
						<form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form'>
							<div class="form-group">
                              <label for="basic2" class="col-sm-1 control-label">门</label>
                              <input type="text" name="case" value="4" style="display: none">
                              <div class="col-sm-9">
                                <select id="basic2" class="show-tick form-control" name="men">
                                <?php if($admin['men'] == '1 多孔动物门 Porifera'){ echo 'selected';}?>
                                  <option>请选择</option>
                                  <option <?php if($admin['men'] == '1 多孔动物门 Porifera'){ echo 'selected';}?>>1 多孔动物门 Porifera</option>
                                  <option <?php if($admin['men'] == '2 扁盘动物门 Placozoa'){ echo 'selected';}?>>2 扁盘动物门 Placozoa</option>
                                  <option <?php if($admin['men'] == '3 单胚动物门 Monoblastozoa'){ echo 'selected';}?>>3 单胚动物门 Monoblastozoa</option>
                        		  <option <?php if($admin['men'] == '4 凡德虫动物门 Vendobionta'){ echo 'selected';}?>>4 凡德虫动物门 Vendobionta</option>
                                  <option <?php if($admin['men'] == '5 栉水母动物门 Ctenophora'){ echo 'selected';}?>>5 栉水母动物门 Ctenophora</option>
                                  <option <?php if($admin['men'] == '6 刺胞动物门 Cnidaria'){ echo 'selected';}?>>6 刺胞动物门 Cnidaria</option>
                                  <option <?php if($admin['men'] == '7 线虫动物门 Nematoda'){ echo 'selected';}?>>7 线虫动物门 Nematoda</option>
                                  <option <?php if($admin['men'] == '8 线形动物门 Nematomorpha'){ echo 'selected';}?>>8 线形动物门 Nematomorpha</option>
                                  <option <?php if($admin['men'] == '9 鳃曳动物门 Priapulida'){ echo 'selected';}?>>9 鳃曳动物门 Priapulida</option>
                                  <option <?php if($admin['men'] == '10 铠甲动物门 Loricifera'){ echo 'selected';}?>>10 铠甲动物门 Loricifera</option>
                                  <option <?php if($admin['men'] == '11 动吻动物门 Kinorhyncha'){ echo 'selected';}?>>11 动吻动物门 Kinorhyncha</option>
                        		  <option <?php if($admin['men'] == '12  叶足动物门 Lobopodia'){ echo 'selected';}?>>12  叶足动物门 Lobopodia</option>
                                  <option <?php if($admin['men'] == '13 有爪动物门 Onychophora'){ echo 'selected';}?>>13 有爪动物门 Onychophora</option>
                                  <option <?php if($admin['men'] == '14 缓步动物门 Tardigrada'){ echo 'selected';}?>>14 缓步动物门 Tardigrada</option>
                                  <option <?php if($admin['men'] == '15 节肢动物门 Arthropoda'){ echo 'selected';}?>>15 节肢动物门 Arthropoda</option>
                                  <option <?php if($admin['men'] == '16 扁形动物门 Platyhelminthes'){ echo 'selected';}?>>16 扁形动物门 Platyhelminthes</option>
                                  <option <?php if($admin['men'] == '17 直泳虫门 Orthonectida'){ echo 'selected';}?>>17 直泳虫门 Orthonectida</option>
                                  <option <?php if($admin['men'] == '18 菱形虫门 Rhombozoa'){ echo 'selected';}?>>18 菱形虫门 Rhombozoa</option>
                                  <option <?php if($admin['men'] == '19 腹毛动物门 Gastrotricha'){ echo 'selected';}?>>19 腹毛动物门 Gastrotricha</option>
                        		  <option <?php if($admin['men'] == '20  苔藓动物门 Bryozoa'){ echo 'selected';}?>>20  苔藓动物门 Bryozoa</option>
                                  <option <?php if($admin['men'] == '21 环口动物门 Cycliophora'){ echo 'selected';}?>>21 环口动物门 Cycliophora</option>
                                  <option <?php if($admin['men'] == '22 内肛动物门 Entoprocta'){ echo 'selected';}?>>22 内肛动物门 Entoprocta</option>
                                  <option <?php if($admin['men'] == '23 原腔动物门 Procoelomata'){ echo 'selected';}?>>23 原腔动物门 Procoelomata</option>
                                  <option <?php if($admin['men'] == '24 轮虫动物门 Rotifera'){ echo 'selected';}?>>24 轮虫动物门 Rotifera</option>
                                  <option <?php if($admin['men'] == '25 棘头动物门 Acanthocephala'){ echo 'selected';}?>>25 棘头动物门 Acanthocephala</option>
                                  <option <?php if($admin['men'] == '26 微颚动物门 Micrognathozoa'){ echo 'selected';}?>>26 微颚动物门 Micrognathozoa</option>
                                  <option <?php if($admin['men'] == '27 颚胃动物门 Gnathostomulida'){ echo 'selected';}?>>27 颚胃动物门 Gnathostomulida</option>
                        		  <option <?php if($admin['men'] == '28  纽形动物门 Nemertea'){ echo 'selected';}?>>28  纽形动物门 Nemertea</option>
                                  <option <?php if($admin['men'] == '29 环节动物门 Annelida'){ echo 'selected';}?>>29 环节动物门 Annelida</option>
                                  <option <?php if($admin['men'] == '30 帚虫动物门 Phoronida'){ echo 'selected';}?>>30 帚虫动物门 Phoronida</option>
                                  <option <?php if($admin['men'] == '31 腕足动物门 Brachiopoda'){ echo 'selected';}?>>31 腕足动物门 Brachiopoda</option>
                                  <option <?php if($admin['men'] == '32 软体动物门 Mollusca'){ echo 'selected';}?>>32 软体动物门 Mollusca</option>
                                  <option <?php if($admin['men'] == '33 毛颚动物门 Chaetognatha'){ echo 'selected';}?>>33 毛颚动物门 Chaetognatha</option>
                                  <option <?php if($admin['men'] == '34 无腔动物门 Acoelomorpha'){ echo 'selected';}?>>34 无腔动物门 Acoelomorpha</option>
                                  <option <?php if($admin['men'] == '35 异涡动物门 Xenoturbellida'){ echo 'selected';}?>>35 异涡动物门 Xenoturbellida</option>
                                  <option <?php if($admin['men'] == '36 古虫动物门 Vetulicolia'){ echo 'selected';}?>>36 古虫动物门 Vetulicolia</option>
                        		  <option <?php if($admin['men'] == '37  棘皮动物门 Echinodermata'){ echo 'selected';}?>>37  棘皮动物门 Echinodermata</option>
                                  <option <?php if($admin['men'] == '38 半索动物门 Hemichordata'){ echo 'selected';}?>>38 半索动物门 Hemichordata</option>
                                  <option <?php if($admin['men'] == '39 脊索动物门 Chordata'){ echo 'selected';}?>>39 脊索动物门 Chordata</option>
                                </select>
                              </div>
                              <div class="col-sm-2">
    							  <button type='submit' class='btn btn-primary'>修改</button>
    						  </div>
                            </div>
                        </form>
                        <form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form'>
                            <div class="form-group">
                              <label for="basic3" class="col-sm-1 control-label">纲</label>
                              <input type="text" name="case" value="5" style="display: none">
                              <div class="col-sm-9">
                                <select id="basic3" class="show-tick form-control" name="gang" >
                                  <option>请选择</option>
                                  <option <?php if($admin['gang'] == '1 石灰海绵纲 Class Calcarea'){ echo 'selected';}?>>1 石灰海绵纲 Class Calcarea</option>
                                  <option <?php if($admin['gang'] == '2 六放海绵纲 Class Hexactinellida'){ echo 'selected';}?>>2 六放海绵纲 Class Hexactinellida </option>
                                  <option <?php if($admin['gang'] == '3 寻常海绵纲 Class Demospongiae'){ echo 'selected';}?>>3 寻常海绵纲 Class Demospongiae</option>
                        		  <option <?php if($admin['gang'] == '4  水螅虫纲 Class Hydrozoa'){ echo 'selected';}?>>4  水螅虫纲 Class Hydrozoa</option>
                                  <option <?php if($admin['gang'] == '5 钵水母纲 Class Scyphzoa'){ echo 'selected';}?>>5 钵水母纲 Class Scyphzoa</option>
                                  <option <?php if($admin['gang'] == '6 珊瑚虫纲 Class Anthozoa'){ echo 'selected';}?>>6 珊瑚虫纲 Class Anthozoa</option>
                                  <option <?php if($admin['gang'] == '7 涡虫纲 Class Turbellaria'){ echo 'selected';}?>>7 涡虫纲 Class Turbellaria</option>
                                  <option <?php if($admin['gang'] == '8 吸虫纲 Class Trematoda'){ echo 'selected';}?>>8 吸虫纲 Class Trematoda</option>
                                  <option <?php if($admin['gang'] == '9 绦虫纲 Class Cestoda'){ echo 'selected';}?>>9 绦虫纲 Class Cestoda</option>
                                  <option <?php if($admin['gang'] == '10 多毛纲 Class Polychaeta'){ echo 'selected';}?>>10 多毛纲 Class Polychaeta</option>
                                  <option <?php if($admin['gang'] == '11 贫毛纲 Class Oligochaeta'){ echo 'selected';}?>>11 贫毛纲 Class Oligochaeta</option>
                        		  <option <?php if($admin['gang'] == '12  蛭纲 Class Hirudinea'){ echo 'selected';}?>>12  蛭纲 Class Hirudinea</option>
                                  <option <?php if($admin['gang'] == '13 腹足纲 Class Gastropoda'){ echo 'selected';}?>>13 腹足纲 Class Gastropoda</option>
                                  <option <?php if($admin['gang'] == '14 双经纲 Class Amphineura'){ echo 'selected';}?>>14 双经纲 Class Amphineura</option>
                                  <option <?php if($admin['gang'] == '15 斧足纲 Class Pelecypoda'){ echo 'selected';}?>>15 斧足纲 Class Pelecypoda</option>
                                  <option <?php if($admin['gang'] == '16 掘足纲 Class Scaphopoda'){ echo 'selected';}?>>16 掘足纲 Class Scaphopoda</option>
                                  <option <?php if($admin['gang'] == '17 头足纲 Class Cephalopoda'){ echo 'selected';}?>>17 头足纲 Class Cephalopoda</option>
                                  <option <?php if($admin['gang'] == '18 甲壳纲 Class Crustacea'){ echo 'selected';}?>>18 甲壳纲 Class Crustacea</option>
                                  <option <?php if($admin['gang'] == '19 倍足纲 Class Diplopoda'){ echo 'selected';}?>>19 倍足纲 Class Diplopoda</option>
                        		  <option <?php if($admin['gang'] == '20  唇足纲 Class Chilopoda'){ echo 'selected';}?>>20  唇足纲 Class Chilopoda</option>
                                  <option <?php if($admin['gang'] == '21 蛛型纲 Class Archnida'){ echo 'selected';}?>>21 蛛型纲 Class Archnida</option>
                                  <option <?php if($admin['gang'] == '22 六足纲 Class Hexapoda'){ echo 'selected';}?>>22 六足纲 Class Hexapoda</option>
                                  <option <?php if($admin['gang'] == '23 切口纲 Class Merostomata'){ echo 'selected';}?>>23 切口纲 Class Merostomata</option>
                                  <option <?php if($admin['gang'] == '24 海星纲 Class Asteroidea'){ echo 'selected';}?>>24 海星纲 Class Asteroidea</option>
                                  <option <?php if($admin['gang'] == '25 蛇尾纲 Class Ophiuroidea'){ echo 'selected';}?>>25 蛇尾纲 Class Ophiuroidea</option>
                                  <option <?php if($admin['gang'] == '26 海胆纲 Class Echinoidea'){ echo 'selected';}?>>26 海胆纲 Class Echinoidea</option>
                                  <option <?php if($admin['gang'] == '27 海e纲 Class Holothuroidea'){ echo 'selected';}?>>27 海e纲 Class Holothuroidea</option>
                        		  <option <?php if($admin['gang'] == '28  海百合纲 Class Crinoidea'){ echo 'selected';}?>>28  海百合纲 Class Crinoidea</option>
                                  <option <?php if($admin['gang'] == '29 软骨鱼纲 Class Chondrichthyes'){ echo 'selected';}?>>29 软骨鱼纲 Class Chondrichthyes</option>
                                  <option <?php if($admin['gang'] == '30 硬骨鱼纲 Class Osteichthyes'){ echo 'selected';}?>>30 硬骨鱼纲 Class Osteichthyes</option>
                                  <option <?php if($admin['gang'] == '31 两生纲 Class Amphibia'){ echo 'selected';}?>>31 两生纲 Class Amphibia</option>
                                  <option <?php if($admin['gang'] == '32 爬虫纲 Class Reptilia'){ echo 'selected';}?>>32 爬虫纲 Class Reptilia</option>
                                  <option <?php if($admin['gang'] == '33 鸟纲 Class Aves'){ echo 'selected';}?>>33 鸟纲 Class Aves</option>
                                  <option <?php if($admin['gang'] == '34 哺乳纲 Class Mammalia'){ echo 'selected';}?>>34 哺乳纲 Class Mammalia</option>
                                </select>
                              </div>
                              <div class="col-sm-2">
    							  <button type='submit' class='btn btn-primary'>修改</button>
    						  </div>
                            </div>
                        </form>
                        <form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form'>
                            <div class="form-group">
                              <label for="basic4" class="col-sm-1 control-label">目</label>
                              <input type="text" name="case" value="6" style="display: none">
                              <div class="col-sm-9">
                                <select id="basic4" class="show-tick form-control" name="mu" >
                                  <option>请选择</option>
                                  <option <?php if($admin['mu'] == '1 等足目'){ echo 'selected';}?>>1 等足目</option>
                                  <option <?php if($admin['mu'] == '2 端足目'){ echo 'selected';}?>>2 端足目</option>
                                  <option <?php if($admin['mu'] == '3 磷虾目'){ echo 'selected';}?>>3 磷虾目</option>
                        		  <option <?php if($admin['mu'] == '4   口足目'){ echo 'selected';}?>>4   口足目</option>
                                  <option <?php if($admin['mu'] == '5 十足目'){ echo 'selected';}?>>5 十足目</option>
                                  <option <?php if($admin['mu'] == '6 直翅目'){ echo 'selected';}?>>6 直翅目</option>
                                  <option <?php if($admin['mu'] == '7 半翅目'){ echo 'selected';}?>>7 半翅目</option>
                                  <option <?php if($admin['mu'] == '8 同翅目'){ echo 'selected';}?>>8 同翅目</option>
                                  <option <?php if($admin['mu'] == '9 鞘翅目'){ echo 'selected';}?>>9 鞘翅目</option>
                                  <option <?php if($admin['mu'] == '10 鳞翅目'){ echo 'selected';}?>>10 鳞翅目</option>
                                  <option <?php if($admin['mu'] == '11 膜翅目'){ echo 'selected';}?>>11 膜翅目</option>
                        		  <option <?php if($admin['mu'] == '12  双翅目'){ echo 'selected';}?>>12  双翅目</option>
                                  <option <?php if($admin['mu'] == '13 鲨目'){ echo 'selected';}?>>13 鲨目</option>
                                  <option <?php if($admin['mu'] == '14 鳐（魟）目'){ echo 'selected';}?>>14 鳐（魟）目</option>
                                  <option <?php if($admin['mu'] == '15 银鲛目'){ echo 'selected';}?>>15 银鲛目</option>
                                  <option <?php if($admin['mu'] == '16 鲟形目'){ echo 'selected';}?>>16 鲟形目</option>
                                  <option <?php if($admin['mu'] == '17 鲱形目'){ echo 'selected';}?>>17 鲱形目</option>
                                  <option <?php if($admin['mu'] == '18 鲑形目'){ echo 'selected';}?>>18 鲑形目</option>
                                  <option <?php if($admin['mu'] == '19 鲤形目'){ echo 'selected';}?>>19 鲤形目</option>
                        		  <option <?php if($admin['mu'] == '20  鳗鲡目'){ echo 'selected';}?>>20  鳗鲡目</option>
                                  <option <?php if($admin['mu'] == '21 海龙目'){ echo 'selected';}?>>21 海龙目</option>
                                  <option <?php if($admin['mu'] == '22 鲈形目'){ echo 'selected';}?>>22 鲈形目</option>
                                  <option <?php if($admin['mu'] == '23 鲽形目'){ echo 'selected';}?>>23 鲽形目</option>
                                  <option <?php if($admin['mu'] == '24 无足目'){ echo 'selected';}?>>24 无足目</option>
                                  <option <?php if($admin['mu'] == '25 有尾目'){ echo 'selected';}?>>25 有尾目</option>
                                  <option <?php if($admin['mu'] == '26 无尾目'){ echo 'selected';}?>>26 无尾目</option>
                                  <option <?php if($admin['mu'] == '27 龟鳖目'){ echo 'selected';}?>>27 龟鳖目</option>
                        		  <option <?php if($admin['mu'] == '28  有鳞目'){ echo 'selected';}?>>28  有鳞目</option>
                                  <option <?php if($admin['mu'] == '29 鳄形目'){ echo 'selected';}?>>29 鳄形目</option>
                                  <option <?php if($admin['mu'] == '30 平胸总目'){ echo 'selected';}?>>30 平胸总目</option>
                                  <option <?php if($admin['mu'] == '31 企鹅总目'){ echo 'selected';}?>>31 企鹅总目</option>
                                  <option <?php if($admin['mu'] == '32 突胸总目'){ echo 'selected';}?>>32 突胸总目</option>
                                  <option <?php if($admin['mu'] == '33 鹳形目'){ echo 'selected';}?>>33 鹳形目</option>
                                  <option <?php if($admin['mu'] == '34 鹈形目'){ echo 'selected';}?>>34 鹈形目</option>
                                  <option <?php if($admin['mu'] == '35 雁形目'){ echo 'selected';}?>>35 雁形目</option>
                        		  <option <?php if($admin['mu'] == '36   隼形目'){ echo 'selected';}?>>36   隼形目</option>
                                  <option <?php if($admin['mu'] == '37 鸡形目'){ echo 'selected';}?>>37 鸡形目</option>
                                  <option <?php if($admin['mu'] == '38 鹤形目'){ echo 'selected';}?>>38 鹤形目</option>
                                  <option <?php if($admin['mu'] == '39 鸽形目'){ echo 'selected';}?>>39 鸽形目</option>
                                  <option <?php if($admin['mu'] == '40 鹃形目'){ echo 'selected';}?>>40 鹃形目</option>
                                  <option <?php if($admin['mu'] == '41 鹦形目'){ echo 'selected';}?>>41 鹦形目</option>
                                  <option <?php if($admin['mu'] == '42 枭形目'){ echo 'selected';}?>>42 枭形目</option>
                                  <option <?php if($admin['mu'] == '43 雨燕目'){ echo 'selected';}?>>43 雨燕目</option>
                        		  <option <?php if($admin['mu'] == '44   鸥形目'){ echo 'selected';}?>>44   鸥形目</option>
                                  <option <?php if($admin['mu'] == '45 雀形目'){ echo 'selected';}?>>45 雀形目</option>
                                  <option <?php if($admin['mu'] == '46 食虫目'){ echo 'selected';}?>>46 食虫目</option>
                                  <option <?php if($admin['mu'] == '47 翼手目'){ echo 'selected';}?>>47 翼手目</option>
                                  <option <?php if($admin['mu'] == '48 鳞甲目'){ echo 'selected';}?>>48 鳞甲目</option>
                                  <option <?php if($admin['mu'] == '49 灵长目'){ echo 'selected';}?>>49 灵长目</option>
                                  <option <?php if($admin['mu'] == '50 兔形目'){ echo 'selected';}?>>50 兔形目</option>
                                  <option <?php if($admin['mu'] == '51 啮齿目'){ echo 'selected';}?>>51 啮齿目</option>
                        		  <option <?php if($admin['mu'] == '52  鲸目'){ echo 'selected';}?>>52  鲸目</option>
                                  <option <?php if($admin['mu'] == '53 食肉目'){ echo 'selected';}?>>53 食肉目</option>
                                  <option <?php if($admin['mu'] == '54 鳍脚目'){ echo 'selected';}?>>54 鳍脚目</option>
                                  <option <?php if($admin['mu'] == '55 奇蹄目'){ echo 'selected';}?>>55 奇蹄目</option>
                                  <option <?php if($admin['mu'] == '56 偶蹄目'){ echo 'selected';}?>>56 偶蹄目</option>
                                  <option <?php if($admin['mu'] == '57 长鼻目'){ echo 'selected';}?>>57 长鼻目</option>
                                </select>
                              </div>
                              <div class="col-sm-2">
    							  <button type='submit' class='btn btn-primary'>修改</button>
    						  </div>
                            </div>
                        </form>
                        <form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form'>
                            <div class="form-group">
                              <label for="basic5" class="col-sm-1 control-label">科</label>
                              <input type="text" name="case" value="7" style="display: none">
                              <div class="col-sm-9">
                                <select id="basic5" class="show-tick form-control" name="ke" >
                                  <option>请选择</option>
                                  <option <?php if($admin['ke'] == '1 懒猴科'){ echo 'selected';}?>>1 懒猴科</option>
                                  <option <?php if($admin['ke'] == '2 猴科'){ echo 'selected';}?>>2 猴科</option>
                                  <option <?php if($admin['ke'] == '3 儒艮科'){ echo 'selected';}?>>3 儒艮科</option>
                        		  <option <?php if($admin['ke'] == '4   海豚科'){ echo 'selected';}?>>4   海豚科</option>
                                  <option <?php if($admin['ke'] == '5 淡水豚科'){ echo 'selected';}?>>5 淡水豚科</option>
                                  <option <?php if($admin['ke'] == '6 象科'){ echo 'selected';}?>>6 象科</option>
                                  <option <?php if($admin['ke'] == '7 长臂猿科'){ echo 'selected';}?>>7 长臂猿科</option>
                                  <option <?php if($admin['ke'] == '8 马科'){ echo 'selected';}?>>8 马科</option>
                                  <option <?php if($admin['ke'] == '9 鲮鲤科'){ echo 'selected';}?>>9 鲮鲤科 </option>
                                  <option <?php if($admin['ke'] == '10 犬科'){ echo 'selected';}?>>10 犬科</option>
                                  <option <?php if($admin['ke'] == '11 骆驼科'){ echo 'selected';}?>>11 骆驼科</option>
                        		  <option <?php if($admin['ke'] == '12  熊科'){ echo 'selected';}?>>12  熊科</option>
                                  <option <?php if($admin['ke'] == '13 鼷鹿科'){ echo 'selected';}?>>13 鼷鹿科</option>
                                  <option <?php if($admin['ke'] == '14 鹿科'){ echo 'selected';}?>>14 鹿科</option>
                                  <option <?php if($admin['ke'] == '15 大熊猫科'){ echo 'selected';}?>>15 大熊猫科</option>
                                  <option <?php if($admin['ke'] == '16 浣熊科'){ echo 'selected';}?>>16 浣熊科</option>
                                  <option <?php if($admin['ke'] == '17 鼬科'){ echo 'selected';}?>>17 鼬科</option>
                                  <option <?php if($admin['ke'] == '18 牛科'){ echo 'selected';}?>>18 牛科</option>
                                  <option <?php if($admin['ke'] == '19 灵猫科'){ echo 'selected';}?>>19 灵猫科</option>
                        		  <option <?php if($admin['ke'] == '20  猫科'){ echo 'selected';}?>>20  猫科</option>
                                  <option <?php if($admin['ke'] == '21 兔科'){ echo 'selected';}?>>21 兔科</option>
                                  <option <?php if($admin['ke'] == '22 松鼠科'){ echo 'selected';}?>>22 松鼠科</option>
                                  <option <?php if($admin['ke'] == '23 河狸科'){ echo 'selected';}?>>23 河狸科</option>
                                  <option <?php if($admin['ke'] == '24 鸊鷉科'){ echo 'selected';}?>>24 鸊鷉科</option>
                                  <option <?php if($admin['ke'] == '25 鹤科'){ echo 'selected';}?>>25 鹤科</option>
                                  <option <?php if($admin['ke'] == '26 信天翁科'){ echo 'selected';}?>>26 信天翁科</option>
                                  <option <?php if($admin['ke'] == '27 鲣鸟科'){ echo 'selected';}?>>27 鲣鸟科</option>
                        		  <option <?php if($admin['ke'] == '28  秧鸡科'){ echo 'selected';}?>>28  秧鸡科</option>
                                  <option <?php if($admin['ke'] == '29 军舰鸟科'){ echo 'selected';}?>>29 军舰鸟科</option>
                                  <option <?php if($admin['ke'] == '30 鹭科'){ echo 'selected';}?>>30 鹭科</option>
                                  <option <?php if($admin['ke'] == '>31 雉鸻科'){ echo 'selected';}?>>31 雉鸻科</option>
                                  <option <?php if($admin['ke'] == '32 鹳科'){ echo 'selected';}?>>32 鹳科</option>
                                  <option <?php if($admin['ke'] == '33 鹬科'){ echo 'selected';}?>>33 鹬科</option>
                                  <option <?php if($admin['ke'] == '34 燕鸻科'){ echo 'selected';}?>>34 燕鸻科</option>
                                  <option <?php if($admin['ke'] == '35 鹮科'){ echo 'selected';}?>>35 鹮科</option>
                        		  <option <?php if($admin['ke'] == '36   鸥科'){ echo 'selected';}?>>36   鸥科</option>
                                  <option <?php if($admin['ke'] == '37 鸭科'){ echo 'selected';}?>>37 鸭科</option>
                                  <option <?php if($admin['ke'] == '38 沙鸡科'){ echo 'selected';}?>>38 沙鸡科</option>
                                  <option <?php if($admin['ke'] == '39 鸠鸽科'){ echo 'selected';}?>>39 鸠鸽科</option>
                                  <option <?php if($admin['ke'] == '40 鹰科'){ echo 'selected';}?>>40 鹰科</option>
                                  <option <?php if($admin['ke'] == '41 鹦鹉科'){ echo 'selected';}?>>41 鹦鹉科</option>
                                  <option <?php if($admin['ke'] == '42 杜鹃科'){ echo 'selected';}?>>42 杜鹃科</option>
                                  <option <?php if($admin['ke'] == '43 雨燕科'){ echo 'selected';}?>>43 雨燕科</option>
                        		  <option <?php if($admin['ke'] == '44   隼科'){ echo 'selected';}?>>44   隼科</option>
                                  <option <?php if($admin['ke'] == '45 凤头雨燕科'){ echo 'selected';}?>>45 凤头雨燕科</option>
                                  <option <?php if($admin['ke'] == '46 松鸡科'){ echo 'selected';}?>>46 松鸡科</option>
                                  <option <?php if($admin['ke'] == '47 咬鹃科'){ echo 'selected';}?>>47 咬鹃科</option>
                                  <option <?php if($admin['ke'] == '48 蜂虎科'){ echo 'selected';}?>>48 蜂虎科</option>
                                  <option <?php if($admin['ke'] == '49 雉科'){ echo 'selected';}?>>49 雉科</option>
                                  <option <?php if($admin['ke'] == '50 犀鸟科'){ echo 'selected';}?>>50 犀鸟科</option>
                                  <option <?php if($admin['ke'] == '51 啄木鸟科'){ echo 'selected';}?>>51 啄木鸟科</option>
                        		  <option <?php if($admin['ke'] == '52  阔嘴鸟科'){ echo 'selected';}?>>52  阔嘴鸟科</option>
                                  <option <?php if($admin['ke'] == '53 八色鸫科'){ echo 'selected';}?>>53 八色鸫科</option>
                                  <option <?php if($admin['ke'] == '54 龟科'){ echo 'selected';}?>>54 龟科</option>
                                  <option <?php if($admin['ke'] == '55 柱头虫科'){ echo 'selected';}?>>55 柱头虫科</option>
                                  <option <?php if($admin['ke'] == '56 玉钩虫科'){ echo 'selected';}?>>56 玉钩虫科</option>
                                  <option <?php if($admin['ke'] == '57 陆龟科'){ echo 'selected';}?>>57 陆龟科</option>
                                  <option <?php if($admin['ke'] == '58 宝贝科'){ echo 'selected';}?>>58 宝贝科</option>
                                  <option <?php if($admin['ke'] == '59 海龟科'){ echo 'selected';}?>>59 海龟科</option>
                        		  <option <?php if($admin['ke'] == '60   冠螺科'){ echo 'selected';}?>>60   冠螺科</option>
                                  <option <?php if($admin['ke'] == '61 珍珠贝科'){ echo 'selected';}?>>61 珍珠贝科</option>
                                  <option <?php if($admin['ke'] == '62 棱皮龟科'){ echo 'selected';}?>>62 棱皮龟科</option>
                                  <option <?php if($admin['ke'] == '63 砗磲科'){ echo 'selected';}?>>63 砗磲科</option>
                                  <option <?php if($admin['ke'] == '64 鳖科'){ echo 'selected';}?>>64 鳖科</option>
                                  <option <?php if($admin['ke'] == '65 蚌科'){ echo 'selected';}?>>65 蚌科</option>
                                  <option <?php if($admin['ke'] == '66 壁虎科'){ echo 'selected';}?>>66 壁虎科</option>
                                  <option <?php if($admin['ke'] == '67 鹦鹉螺科'){ echo 'selected';}?>>67 鹦鹉螺科</option>
                        		  <option <?php if($admin['ke'] == '68   鳄蜥科'){ echo 'selected';}?>>68   鳄蜥科</option>
                                  <option <?php if($admin['ke'] == '69 巨蜥科'){ echo 'selected';}?>>69 巨蜥科</option>
                                  <option <?php if($admin['ke'] == '70 铗[虫八]科'){ echo 'selected';}?>>70 铗[虫八]科</option>
                                  <option <?php if($admin['ke'] == '71 蛇目蟒科'){ echo 'selected';}?>>71 蛇目蟒科</option>
                                  <option <?php if($admin['ke'] == '72 箭蜓科'){ echo 'selected';}?>>72 箭蜓科</option>
                                  <option <?php if($admin['ke'] == '73 鼍科（短吻鳄科）'){ echo 'selected';}?>>73 鼍科（短吻鳄科）</option>
                                  <option <?php if($admin['ke'] == '74 缺翅虫科'){ echo 'selected';}?>>74 缺翅虫科</option>
                                  <option <?php if($admin['ke'] == '75 蝾螈科'){ echo 'selected';}?>>75 蝾螈科</option>
                        		  <option <?php if($admin['ke'] == '76  蛩蠊科'){ echo 'selected';}?>>76  蛩蠊科</option>
                                  <option <?php if($admin['ke'] == '77 步甲科'){ echo 'selected';}?>>77 步甲科</option>
                                  <option <?php if($admin['ke'] == '78 蛙科'){ echo 'selected';}?>>78 蛙科</option>
                                  <option <?php if($admin['ke'] == '79 臂金龟科'){ echo 'selected';}?>>79 臂金龟科</option>
                                  <option <?php if($admin['ke'] == '80 犀金龟科'){ echo 'selected';}?>>80 犀金龟科</option>
                                  <option <?php if($admin['ke'] == '81 石首鱼科'){ echo 'selected';}?>>81 石首鱼科</option>
                                  <option <?php if($admin['ke'] == '82 凤蝶科'){ echo 'selected';}?>>82 凤蝶科</option>
                                  <option <?php if($admin['ke'] == '83 杜父鱼科'){ echo 'selected';}?>>83 杜父鱼科</option>
                                  <option <?php if($admin['ke'] == '84 海龙鱼科'){ echo 'selected';}?>>84 海龙鱼科</option>
                                  <option <?php if($admin['ke'] == '85 胭脂鱼科'){ echo 'selected';}?>>85 胭脂鱼科</option>
                        		  <option <?php if($admin['ke'] == '86  绢蝶科'){ echo 'selected';}?>>86  绢蝶科</option>
                                  <option <?php if($admin['ke'] == '87 鲤科'){ echo 'selected';}?>>87 鲤科</option>
                                  <option <?php if($admin['ke'] == '88 柳珊瑚目红珊瑚科'){ echo 'selected';}?>>88 柳珊瑚目红珊瑚科</option>
                                  <option <?php if($admin['ke'] == '89 鳗鲡科'){ echo 'selected';}?>>89 鳗鲡科</option>
                                  <option <?php if($admin['ke'] == '90 鲑科'){ echo 'selected';}?>>90 鲑科</option>
                                  <option <?php if($admin['ke'] == '91 鲟科'){ echo 'selected';}?>>91 鲟科</option>
                                  <option <?php if($admin['ke'] == '92 匙吻鲟科'){ echo 'selected';}?>>92 匙吻鲟科</option>
                                  <option <?php if($admin['ke'] == '93 文昌鱼科（鳃口科）'){ echo 'selected';}?>>93 文昌鱼科（鳃口科）</option>
                                </select>
                              </div>
                              <div class="col-sm-2">
    							  <button type='submit' class='btn btn-primary'>修改</button>
    						  </div>
                            </div>
                        </form>  
                        <form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form'> 
                            <div class="form-group">
								<label class="col-sm-1 control-label">属</label>
								<input type="text" name="case" value="8" style="display: none">
								<div class="col-sm-9">
									<input type="text" name="shu" class="form-control" value="<?php echo $admin['shu']?>" placeholder="属">
								</div>
								<div class="col-sm-2">
									<button type='submit' class='btn btn-primary'>修改</button>
								</div>
							</div>
						</form> 
						<form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form'> 
							<div class="form-group">
								<label class="col-sm-1 control-label">种</label>
								<input type="text" name="case" value="9" style="display: none">
								<div class="col-sm-9">
									<input type="text" name="zhong" class="form-control" value="<?php echo $admin['zhong']?>" placeholder="种">
								</div>
								<div class="col-sm-2">
									<button type='submit' class='btn btn-primary'>修改</button>
								</div>
							</div>
						</form> 
						<form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form'> 
    					    <div class='form-group'>
    						  <label class='col-sm-1 control-label'>保护级别</label>
    						  <input type="text" name="case" value="10" style="display: none">
    			   		      <div class='col-sm-9'>
    			    			<input type='text' name='protect_grade' value='<?php echo $admin['protect_grade']?>' class='form-control' placeholder='保护级别'>
    						  </div>
    						  <div class='col-sm-2'>
    							<button type='submit' class='btn btn-primary'>修改</button>
    						  </div>
    					   </div>
    					</form>
    					<?php 
						    $array = explode('-',$admin['number']);
						    $a1 = explode(' ',$array['0']);
						    $a2 = explode(' ',$array['1']);
						?>
    					<form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form'> 
    					<div class="form-group">
								<label class="col-sm-1 control-label text-left" style="padding-top:0px;">种群数量</label>
								<input type="text" name="case" value="11" style="display: none">
								<div class="col-sm-1">
									<input type="text" name="year1" class="form-control" value="<?php echo $a1[0];?>" placeholder="日期">
								</div>
								<div class="col-sm-1">
									<input type="text" name="year2" class="form-control" value="<?php echo $a1[1];?>" placeholder="日期">
								</div>
								<div class="col-sm-1">
									<input type="text" name="year3" class="form-control" value="<?php echo $a1[2];?>" placeholder="日期">
								</div>
								<div class="col-sm-1">
									<input type="text" name="year4" class="form-control" value="<?php echo $a1[3];?>" placeholder="日期">
								</div>
								<div class="col-sm-1">
									<input type="text" name="year5" class="form-control" value="<?php echo $a1[4];?>" placeholder="日期">
								</div>
								<div class="col-sm-1">
									<input type="text" name="year6" class="form-control" value="<?php echo $a1[5];?>" placeholder="日期">
								</div>
								<div class="col-sm-1">
									<input type="text" name="year7" class="form-control" value="<?php echo $a1[6];?>" placeholder="日期">
								</div>
								<div class="col-sm-1">
									<input type="text" name="year8" class="form-control" value="<?php echo $a1[7];?>" placeholder="日期">
								</div>
								<div class="col-sm-1">
									<input type="text" name="year9" class="form-control" value="<?php echo $a1[8];?>" placeholder="日期">
								</div>
								<div class="col-sm-1">
									<input type="text" name="year10" class="form-control" value="<?php echo $a1[9];?>" placeholder="日期">
								</div>
								<div class="col-sm-1 col-sm-offset-1">
									<input type="text" name="number1" class="form-control" value="<?php echo $a2[0];?>" placeholder="数字">
								</div>
								<div class="col-sm-1">
									<input type="text" name="number2" class="form-control" value="<?php echo $a2[1];?>" placeholder="数字">
								</div>
								<div class="col-sm-1">
									<input type="text" name="number3" class="form-control" value="<?php echo $a2[2];?>" placeholder="数字">
								</div>
								<div class="col-sm-1">
									<input type="text" name="number4" class="form-control" value="<?php echo $a2[3];?>" placeholder="数字">
								</div>
								<div class="col-sm-1">
									<input type="text" name="number5" class="form-control" value="<?php echo $a2[4];?>" placeholder="数字">
								</div>
								<div class="col-sm-1">
									<input type="text" name="number6" class="form-control" value="<?php echo $a2[5];?>" placeholder="数字">
								</div>
								<div class="col-sm-1">
									<input type="text" name="number7" class="form-control" value="<?php echo $a2[6];?>" placeholder="数字">
								</div>
								<div class="col-sm-1">
									<input type="text" name="number8" class="form-control" value="<?php echo $a2[7];?>" placeholder="数字">
								</div>
								<div class="col-sm-1">
									<input type="text" name="number9" class="form-control" value="<?php echo $a2[8];?>" placeholder="数字">
								</div>
								<div class="col-sm-1">
									<input type="text" name="number10" class="form-control" value="<?php echo $a2[9];?>" placeholder="数字">
								</div>
								<div class="col-sm-1">
									<button type='submit' class='btn btn-primary'>修改</button>
								</div>
							</div>
						</form>	
    					<form action='change_data/change_data.php' method='post' target='animals' class='form-horizontal' role='form' enctype="multipart/form-data" -> 
    				       <div class='form-group'>
    				           <label class='col-sm-1 control-label text-left' style='padding-top:0px;'>正文输入</label>
    				           <input type="text" name="case" value="12" style="display: none">
    				           <div class='col-sm-10'>
    					          <textarea  name='info' class='form-control' id='tid' rows='16'><?php echo $admin['document']?></textarea>
    					          <?php endforeach;?>
    				           </div>
    				      </div>
    					  <div class='form-group'>
    						<div class='col-sm-offset-2 col-sm-10'>
    							<button type='submit' class='btn btn-primary'>修改</button>
    						</div>
    					  </div>
					  </form>
					  <iframe name='animals' frameborder = '1' src='' style='display:none;'></iframe>
            	   </div>
				   <div class='clearfix' ></div>
            	 </div>
               </div>
               <div class="demo col-md-12" style="margin-bottom:30px;">
                    <h3><span class="counter"></span>说说你的想法...</h3>
                    <div class="clear"></div>
                    <div id="saywrap">
                        <?php foreach ($rows_say as $admin):?>
                        <div class="saylist">
                    	    <a href="javascript:void(0)"><img src="images_/<?php echo (rand()%5); ?>.jpg" width="50" height="50" alt="demo" /></a>
                        	    <div class="saytxt">
                        	        <p>
                        	           <strong><a href="javascript:void(0)">游客_<?php echo rand(0,100);?></a></strong><?php echo preg_replace('/((?:http|https|ftp):\/\/(?:[A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?[^\s\"\']+)/i','<a href="$1" rel="nofollow"  target="blank">$1</a>',$admin['content']); ?>
                        	        </p>
                        	        <div class="date"><?php echo tranTime($admin['addtime']); ?></div>
                        	        <a href="#" class="pull-right"><span class="delete" data_id = '<?php echo $admin['id']; ?>'>删除</span></a>
                        	    </div>
                        	    <div class="clear"></div>
                    	</div>
                    	<?php endforeach;?>
                    </div>
                    <nav>
    					<ul class="pagination pull-right">
    					<?php
    					   for($i = 1;$i<=$sumPage_say;$i++){
    					       echo "<li><a href='change_animals.php?page_say={$i}&id={$animals_id}'>$i</a></li>";
    					   } echo "<li>第{$page_say}页<li>";   					
    					?>
    					</ul>
				   </nav>
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
            		    $(".delete").click(function(){
            		    	var id = $(this).attr("data_id");
            		        var msg = "您真的确定要删除吗？\n\n请确认！";
            		        if (confirm(msg)==true){
            		        	var url = "delect_data/delect_data.php?say_id_animals="+id;
                		        $.get(url);
                		        $(this).parent().parent().parent().empty();
            		        }else{
            		            return false;
            		        }
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
        <div class="jumbotron col-md-12" >
        	<div class="container" style="text-align: center">
        	<span>Copyright&nbsp;©&nbsp;2017&nbsp;hainananimals.com,All rights reserved.<a href = "http://www.miitbeian.gov.cn">琼ICP备17001532号</a></span>
        	</div>
        </div>
    </body>
</html>