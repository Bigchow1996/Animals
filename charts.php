<?
require_once 'acl.inc.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
<title>详情</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="dist/css/bootstrap-select.css">
<link rel="stylesheet" type="text/css" href="css/card.css"/>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="dist/js/bootstrap-select.js"></script>
<script type="text/javascript" charset="utf-8" src="editor/kindeditor-min.js"></script>
<script src="js/echarts.min.js"></script>
<script type="text/javascript">
var editor;
KindEditor.ready(function(K){
    editor = K.create("#tid",{
        resizeType : 1,
        width:"100%",
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
    <li class="active"><a href="charts.php">数据可视化</a></li>
    
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
    <h3><strong><?php session_start(); echo $_SESSION["name"];?></strong></h3>
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

                <div id="charts_1" style="height:500px;border:1px solid red;"  class="col-md-12"></div>
    			<script type="text/javascript">
    	        // 基于准备好的dom，初始化echarts实例
    	        var myChart = echarts.init(document.getElementById('charts_1'));
    	
    	        // 指定图表的配置项和数据
    	        var option = {
	        	    title : {
	        	        text: '南丁格尔玫瑰图',
	        	        subtext: '不同物种',
	        	        x:'center'
	        	    },
	        	    tooltip : {
	        	        trigger: 'item',
	        	        formatter: "{a} <br/>{b} : {c} ({d}%)"
	        	    },
	        	    legend: {
	        	        x : 'center',
	        	        y : 'bottom',
	        	        data:['物种1','物种2','物种3','物种4','物种5','物种6','物种7','物种8']
	        	    },
	        	    toolbox: {
	        	        show : true,
	        	        feature : {
	        	            mark : {show: true},
	        	            dataView : {show: true, readOnly: false},
	        	            magicType : {
	        	                show: true, 
	        	                type: ['pie', 'funnel']
	        	            },
	        	            restore : {show: true},
	        	            saveAsImage : {show: true}
	        	        }
	        	    },
	        	    calculable : true,
	        	    series : [
	        	        {
	        	            name:'半径模式',
	        	            type:'pie',
	        	            radius : [20, 110],
	        	            center : ['25%', 200],
	        	            roseType : 'radius',
	        	            width: '40%',       // for funnel
	        	            max: 40,            // for funnel
	        	            itemStyle : {
	        	                normal : {
	        	                    label : {
	        	                        show : false
	        	                    },
	        	                    labelLine : {
	        	                        show : false
	        	                    }
	        	                },
	        	                emphasis : {
	        	                    label : {
	        	                        show : true
	        	                    },
	        	                    labelLine : {
	        	                        show : true
	        	                    }
	        	                }
	        	            },
	        	            data:[
	        	                {value:10, name:'物种1'},
	        	                {value:5, name:'物种2'},
	        	                {value:15, name:'物种3'},
	        	                {value:25, name:'物种4'},
	        	                {value:20, name:'物种5'},
	        	                {value:35, name:'物种6'},
	        	                {value:30, name:'物种7'},
	        	                {value:40, name:'物种8'}
	        	            ]
	        	        },
	        	        {
	        	            name:'面积模式',
	        	            type:'pie',
	        	            radius : [30, 110],
	        	            center : ['75%', 200],
	        	            roseType : 'area',
	        	            x: '50%',               // for funnel
	        	            max: 40,                // for funnel
	        	            sort : 'ascending',     // for funnel
	        	            data:[
	        	                {value:10, name:'物种1'},
	        	                {value:5, name:'物种2'},
	        	                {value:15, name:'物种3'},
	        	                {value:25, name:'物种4'},
	        	                {value:20, name:'物种5'},
	        	                {value:35, name:'物种6'},
	        	                {value:30, name:'物种7'},
	        	                {value:40, name:'物种8'}
	        	            ]
	        	        }
	        	    ]
	        	};
    	        myChart.setOption(option);
    	        </script>
    	        
                <div id="charts_2" style="height:500px;border:1px solid red;" class="col-md-12"></div>
    			<script type="text/javascript">
    	        // 基于准备好的dom，初始化echarts实例
    	        var myChart = echarts.init(document.getElementById('charts_2'));
    	
    	        // 指定图表的配置项和数据
    	        var option = {
    	        	    title : {
    	        	        text: '多雷达图',
    	        	        subtext: '坡鹿'
    	        	    },
    	        	    tooltip : {
    	        	        trigger: 'axis'
    	        	    },
    	        	    legend: {
    	        	        x : 'center',
    	        	        data:['食性','雄性','雌性','活动时间','繁殖时间']
    	        	    },
    	        	    toolbox: {
    	        	        show : true,
    	        	        feature : {
    	        	            mark : {show: true},
    	        	            dataView : {show: true, readOnly: false},
    	        	            restore : {show: true},
    	        	            saveAsImage : {show: true}
    	        	        }
    	        	    },
    	        	    calculable : true,
    	        	    polar : [
    	        	        {
    	        	            indicator : [
    	        	                {text : '植物1', max  : 100},
    	        	                {text : '植物2', max  : 100},
    	        	                {text : '植物3', max  : 100},
    	        	                {text : '植物4', max  : 100}
    	        	            ],
    	        	            center : ['25%',200],
    	        	            radius : 80
    	        	        },
    	        	        {
    	        	            indicator : [
    	        	                {text : '奔跑', max  : 100},
    	        	                {text : '跳跃', max  : 100},
    	        	                {text : '体重', max  : 100},
    	        	                {text : '视觉', max  : 100},
    	        	                {text : '听觉', max  : 100}
    	        	            ],
    	        	            radius : 80
    	        	        },
    	        	        {
    	        	            indicator : (function (){
    	        	                var res = [];
    	        	                for (var i = 1; i <= 12; i++) {
    	        	                    res.push({text:i+'月',max:100});
    	        	                }
    	        	                return res;
    	        	            })(),
    	        	            center : ['75%', 200],
    	        	            radius : 80
    	        	        }
    	        	    ],
    	        	    series : [
    	        	        {
    	        	            type: 'radar',
    	        	             tooltip : {
    	        	                trigger: 'item'
    	        	            },
    	        	            itemStyle: {normal: {areaStyle: {type: 'default'}}},
    	        	            data : [
    	        	                {
    	        	                    value : [60,73,85,40],
    	        	                    name : '食性'
    	        	                }
    	        	            ]
    	        	        },
    	        	        {
    	        	            type: 'radar',
    	        	            polarIndex : 1,
    	        	            data : [
    	        	                {
    	        	                    value : [85, 90, 90, 95, 95],
    	        	                    name : '雄性'
    	        	                },
    	        	                {
    	        	                    value : [95, 80, 95, 90, 93],
    	        	                    name : '雌性'
    	        	                }
    	        	            ]
    	        	        },
    	        	        {
    	        	            type: 'radar',
    	        	            polarIndex : 2,
    	        	            itemStyle: {normal: {areaStyle: {type: 'default'}}},
    	        	            data : [
    	        	                {
    	        	                    name : '活动时间',
    	        	                    value : [2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 75.6, 82.2, 48.7, 18.8, 6.0, 2.3],
    	        	                },
    	        	                {
    	        	                    name:'繁殖时间',
    	        	                    value:[2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 35.6, 62.2, 32.6, 20.0, 6.4, 3.3]
    	        	                }
    	        	            ]
    	        	        }
    	        	    ]
    	        	};
    	        myChart.setOption(option);
    	        </script>
                <div id="charts_3" style="height:600px;border:1px solid red;"  class="col-md-12"></div>
    			<script type="text/javascript">
    	        // 基于准备好的dom，初始化echarts实例
    	        var myChart = echarts.init(document.getElementById('charts_3'));
    	
    	        // 指定图表的配置项和数据
    	        var option = {
    	        	    title: {
    	        	        text: ''
    	        	    },
    	        	    tooltip: {},
    	        	    animationDurationUpdate: 1500,
    	        	    animationEasingUpdate: 'quinticInOut',
    	        	    label: {
    	        	        normal: {
    	        	            show: true,
    	        	            textStyle: {
    	        	                fontSize: 12
    	        	            },
    	        	        }
    	        	    },
    	        	    legend: {
    	        	        x: "center",
    	        	        show:false,
    	        	        data: ["捕食关系", "竞争关系", '互利共生关系']
    	        	    },
    	        	    series: [

    	        	        {
    	        	            type: 'graph',
    	        	            layout: 'force',
    	        	            symbolSize: 45,
    	        	            focusNodeAdjacency: true,
    	        	            roam: true,
    	        	            categories: [{
    	        	                name: '捕食关系',
    	        	                itemStyle: {
    	        	                    normal: {
    	        	                        color: "#009800",
    	        	                    }
    	        	                }
    	        	            }, {
    	        	                name: '竞争关系',
    	        	                itemStyle: {
    	        	                    normal: {
    	        	                        color: "#4592FF",
    	        	                    }
    	        	                }
    	        	            }, {
    	        	                name: '互利共生关系',
    	        	                itemStyle: {
    	        	                    normal: {
    	        	                        color: "#3592F",
    	        	                    }
    	        	                }
    	        	            }],
    	        	            label: {
    	        	                normal: {
    	        	                    show: true,
    	        	                    textStyle: {
    	        	                        fontSize: 12
    	        	                    },
    	        	                }
    	        	            },
    	        	            force: {
    	        	                repulsion: 1000
    	        	            },
    	        	            edgeSymbolSize: [4, 50],
    	        	            edgeLabel: {
    	        	                normal: {
    	        	                    show: true,
    	        	                    textStyle: {
    	        	                        fontSize: 10
    	        	                    },
    	        	                    formatter: "{c}"
    	        	                }
    	        	            },
    	        	            data: [{
    	        	                name: '物种1',
    	        	            draggable: true,
    	        	            }, {
    	        	                name: '物种2',
    	        	            category: 1,
    	        	            draggable: true,
    	        	            }, {
    	        	                name: '物种3',
    	        	            category: 1,
    	        	            draggable: true,
    	        	            }, {
    	        	                name: '物种4',
    	        	            category: 1,
    	        	            draggable: true,
    	        	            }, {
    	        	                name: '物种5',
    	        	            category: 1,
    	        	            draggable: true,
    	        	            }, {
    	        	                name: '物种6',
    	        	            category: 1,
    	        	            draggable: true,
    	        	            }, {
    	        	                name: '物种7',
    	        	            category: 1,
    	        	            draggable: true,
    	        	            }, {
    	        	                name: '物种8',
    	        	            category: 1,
    	        	            draggable: true,
    	        	            }, {
    	        	                name: '物种9',
    	        	            category: 1,
    	        	            draggable: true,
    	        	            }, {
    	        	                name: '物种10',
    	        	            category: 1,
    	        	            draggable: true,
    	        	            }, {
    	        	                name: '物种11',
    	        	            category: 1,
    	        	            draggable: true,
    	        	            }, {
    	        	                name: '物种12',
    	        	            category: 1,
    	        	            draggable: true,
    	        	            }, {
    	        	                name: '物种13',
    	        	            category: 1,
    	        	            draggable: true,
    	        	            }],
    	        	            links: [{
    	        	                source: 0,
    	        	                target: 1,
    	        	            category: 0,
    	        	                value: '捕食关系'
    	        	            },{
    	        	                source: 0,
    	        	                target: 2,
    	        	                value: '捕食关系'
    	        	            },{
    	        	                source: 0,
    	        	                target: 3,
    	        	                value: '捕食关系'
    	        	            }, {
    	        	                source: 0,
    	        	                target: 4,
    	        	                value: '捕食关系'
    	        	            }, {
    	        	                source: 0,
    	        	                target: 5,
    	        	                value: '捕食关系'
    	        	            }, {
    	        	                source: 4,
    	        	                target: 5,
    	        	                value: '竞争关系'
    	        	            }, {
    	        	                source: 2,
    	        	                target: 8,
    	        	                value: '互利共生关系'
    	        	            }, {
    	        	                source: 0,
    	        	                target: 12,
    	        	                value: ''
    	        	            }, {
    	        	                source: 6,
    	        	                target: 11,
    	        	                value: '捕食关系'
    	        	            }, {
    	        	                source: 6,
    	        	                target: 3,
    	        	                value: '捕食关系'
    	        	            }, {
    	        	                source: 7,
    	        	                target: 5,
    	        	                value: '捕食关系'
    	        	            }, {
    	        	                source: 9,
    	        	                target: 10,
    	        	                value: '捕食关系'
    	        	            }, {
    	        	                source: 3,
    	        	                target: 10,
    	        	                value: '捕食关系'
    	        	            }],
    	        	            lineStyle: {
    	        	                normal: {
    	        	                    opacity: 0.9,
    	        	                    width: 1,
    	        	                    curveness: 0
    	        	                }
    	        	            }
    	        	        }
    	        	    ]
    	        	};
 	        	   myChart.setOption(option);
    	        </script>




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