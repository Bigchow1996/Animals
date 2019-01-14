<?php
session_start();
define('INCLUDE_CHECK',1);
require_once('connect.php');
require_once('function_.php');
require_once 'functions/mysql.func.php';
require_once 'config/config.php';
header("content-type:text/html;charset=utf-8");
$link = connect3();
$news_id = $_GET['news_id']?$_GET['news_id']:1;
$_SESSION['sayid'] = $news_id;
$page_say = $_GET['page_say']?$_GET['page_say']:1;
$pageSize = 5;
$offset_say = ($page_say - 1)*5;
$sql = "select * from say where userid = {$news_id}";
$result=mysql_query($sql);
$totalRows_say=mysql_num_rows($result);
$sumPage_say = ceil($totalRows_say/$pageSize);

$table_news = "news";

$query_news = "select * from news where id = {$news_id}";

$rows_news = fetchAll($link,$query_news);

$query = "select * from say where userid = {$news_id} order by id desc limit {$offset_say},{$pageSize}";
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
    <link rel="stylesheet" href="css/main.css">
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="dist/js/bootstrap-select.js"></script>
    <script type="text/javascript" charset="utf-8" src="editor/kindeditor.js"></script>  
	<script type="text/javascript">
	var editor;
    KindEditor.ready(function(K){
        editor = K.create("#tid",{
        	resizeType : 1,  
        	width : "100%",
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
        		    <div class='panel-heading'>修改数据(新闻)</div>
            	    <div class='changeCon panel-body'>
            	    
            	       <form action='change_data/change_news.php' method='post' target='news' class='form-horizontal' role='form'>
                           <div class='form-group'>
                               <input type="text" name="case" value="1" style="display: none">
                    	       <label class='col-sm-1 control-label'>编号</label>
                	           <div class='col-sm-9'>
                	           <?php foreach ($rows_news as $admin):?>
               		            <input type='text' name='change_id' value="<?php echo $admin['id']?>" class='form-control' placeholder='编号'>
    				           </div>
    			               <div class='col-sm-2'>	
    			                <button type='submit' class='btn btn-primary'>修改</button>					
    				           </div>
    			           </div>
    			        </form> 
    			        <form action='change_data/change_news.php' method='post' target='news' class='form-horizontal' role='form'>
                           <div class='form-group'>
                              <input type="text" name="case" value="2" style="display: none">
                    	      <label class='col-sm-1 control-label'>标题</label>
                    	      <div class='col-sm-9'>
                    		    <input type='text' name='title' value='<?php echo $admin['title']?>' class='form-control'>
    					      </div>
    					      <div class='col-sm-2'>	
    			                <button type='submit' class='btn btn-primary'>修改</button>					
    				          </div>
    			           </div>
    			        </form> 
    			        <form action='change_data/change_news.php' method='post' target='news' class='form-horizontal' role='form'>
    					   <div class='form-group'>
    					      <input type="text" name="case" value="3" style="display: none">
                    	      <label class='col-sm-1 control-label'>作者&来源</label>
                    	      <div class='col-sm-9'>
                    		    <input type='text' name='author' value='<?php echo $admin['author']?>' class='form-control'>
    					      </div>
    					      <div class='col-sm-2'>	
    			                <button type='submit' class='btn btn-primary'>修改</button>					
    				          </div>
    			           </div>
    			         </form> 
    			         <form action='change_data/change_news.php' method='post' target='news' class='form-horizontal' role='form'>
    			           <div class='form-group'>
    			              <input type="text" name="case" value="4" style="display: none">
                    	      <label class='col-sm-1 control-label'>简介</label>
                    	      <div class='col-sm-9'>
                    		    <input type='text' name='jianjie' value='<?php echo $admin['jianjie']?>' class='form-control'>
    					      </div>
    					      <div class='col-sm-2'>	
    			                <button type='submit' class='btn btn-primary'>修改</button>					
    				          </div>
    			           </div>
    			         </form>
    			         <form action='change_data/change_news.php' method='post' target='news' class='form-horizontal' role='form'>
    				       <div class='form-group'>
    				           <input type="text" name="case" value="5" style="display: none">
    				           <label class='col-sm-1 control-label text-left' style='padding-top:0px;'>正文输入</label>
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
					  <iframe name='news' frameborder = '1' src='' style='display:none;'></iframe>
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
    					       echo "<li><a href='change_news.php?page_say={$i}&news_id={$news_id}'>$i</a></li>";
    					   }echo "<li>第{$page_say}页<li>";
    					?>
    					</ul>
				   </nav>
               </div> 
            <script>
            	  $(function(){
        		        $(".delete").click(function(){
            		        var id = $(this).attr("data_id");
            		        var msg = "您真的确定要删除吗？\n\n请确认！";
            		        if (confirm(msg)==true){
            		        	var url = "delect_data/delect_news.php?say_id="+id;
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
