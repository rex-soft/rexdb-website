<!DOCTYPE html>
<html>
<head>
<title>性能 - Rexdb</title>
<?
include_once('include/import.php'); 
?>
<script type="text/javascript" src="<?=$basePath?>style/highcharts-4.2.3/highcharts.js"></script>
<script type="text/javascript" src="<?=$basePath?>style/highcharts-4.2.3/highcharts-3d.js"></script>
<script type="text/javascript" src="<?=$basePath?>style/highcharts-4.2.3/modules/exporting.js"></script>
<script type="text/javascript" src="<?=$basePath?>style/performance.js"></script>
<script>
$(document).ready(function(){
	$("a[data-toggle='popover']").popover({
		html: true,
		content: function(){
			return $($(this).attr('ref')).html();
		}
	});
});

var testResult = {
    "insert-100": {
        "hibernate": 454,
        "mybatis": 264,
        "jdbc": 267,
        "rexdb": 251
    },
    "insert-200": {
        "hibernate": 738,
        "mybatis": 533,
        "jdbc": 492,
        "rexdb": 495
    },
    "insert-500": {
        "hibernate": 1743,
        "mybatis": 1217,
        "jdbc": 1161,
        "rexdb": 1210
    },
    "batchInsert-10k": {
        "hibernate": 481,
        "mybatis": 379,
        "jdbc": 229,
        "rexdb": 249
    },
    "batchInsert-50k": {
        "hibernate": 1761,
        "mybatis": 1576,
        "jdbc": 1224,
        "rexdb": 1428
    },
    "batchInsert-100k": {
        "hibernate": 4246,
        "mybatis": 2861,
        "jdbc": 2374,
        "rexdb": 2573
    },
    "getList-10k": {
        "hibernate": 472,
        "mybatis": 240,
        "jdbc": 747,
        "rexdb": 832
    },
    "getMapList-10k": {
        "hibernate": 197,
        "mybatis": 200,
        "jdbc": 684,
        "rexdb": 128
    },
    "getList-disableDynamic-10k": {
        "hibernate": 209,
        "mybatis": 175,
        "jdbc": 123,
        "rexdb": 100
    },
    "getList-50k": {
        "hibernate": 704,
        "mybatis": 596,
        "jdbc": 459,
        "rexdb": 310
    },
    "getMapList-50k": {
        "hibernate": 426,
        "mybatis": 595,
        "jdbc": 397,
        "rexdb": 307
    },
    "getList-disableDynamic-50k": {
        "hibernate": 748,
        "mybatis": 609,
        "jdbc": 325,
        "rexdb": 436
    },
    "getList-100k": {
        "hibernate": 1758,
        "mybatis": 1216,
        "jdbc": 782,
        "rexdb": 607
    },
    "getMapList-100k": {
        "hibernate": 904,
        "mybatis": 1114,
        "jdbc": 911,
        "rexdb": 711
    },
    "getList-disableDynamic-100k": {
        "hibernate": 1472,
        "mybatis": 1312,
        "jdbc": 591,
        "rexdb": 595
    }
};
	
</script>
<style>
p {
	font-size: 16px;
}

blockquote {
	font-size: 15.5px;
}

li {
	list-style-type: disc;
}
h4 {
    font-size: 18px;
    color: #333;
}
input[type="radio"], input[type="checkbox"] {
    margin: 6px 0 0;
}
.popover{
	max-width: 500px
}
.bs-callout {
    padding: 10px 20px;
    margin: 20px 0;
    border: 1px solid #eee;
    border-left-width: 5px;
    border-radius: 3px;
}
.bs-callout-info {
    border-left-color: #1b809e;
}
</style>
</head>
<body>
<? 
$activeMenu = 'performance';
include_once('include/navbar.php'); 
?>

<div class="container top-div">

		<div class="row" style="margin-top: 20px; margin-bottom: 20px">
			<div class="col-md-12">
				<h2>性能测试</h2>
				<p>
				我们进行了一系列检测，并且与JDBC和同类框架进行了比较。
				由于Rexdb封装了JDBC，并且扩展了额外的功能，因此理论上性能不会好于直接调用JDBC的接口。但可以通过代码优化，尽可能的降低不必要的性能损耗。
				</p>
				<p>
				性能测试结果与软硬件环境、框架版本、配置选项等相关，并不是每一次测试都能得出相同的结论，但可以作为性能对比的参考。
				以下均为某一次的测试结果，具体数值可能是不准确的，与您自行测试的结果也可能有较大的偏差。
				您可以自行运行测试程序，以获得准确的数值。
				我们的测试环境为<a href="#" data-toggle="popover" data-placement="auto bottom" data-trigger="hover" title="台式机电脑系统" ref="#env-pc">台式机电脑系统</a>，完整的测试程序请<a href="#">点击这里</a>下载。
				</p>
				<p>
				测试程序中的Hibernate等框架并未进行有针对性的优化，因此它们的测试结果仅供参考。默认图示中没有显示这些框架的性能，您可以从下面选择查看。
				</p>
				<div class="bs-callout bs-callout-info">
    				<h4>查看测试结论（<a href="#">全部显示</a>）</h4>
    				<p>
						<label class="checkbox-inline">
						  <input type="checkbox" id="rexdb" value="rexdb" checked="checked" disabled="disabled"> Rexdb
						</label>
						<label class="checkbox-inline">
						  <input type="checkbox" id="jdbc" value="jdbc" checked="checked" disabled="disabled"> JDBC
						</label>
						<label class="checkbox-inline">
						  <input type="checkbox" id="hibernate" value="hibernate"> Hibernate
						</label>
						<label class="checkbox-inline">
						  <input type="checkbox" id="mybatis" value="mybatis"> Mybatis
						</label>
						<label class="checkbox-inline">
						  <input type="checkbox" id="spring" value="spring"> Spring JDBC
						</label>
    				</p>
  				</div>
				
				<div id="env-pc" style="display: none">
					<ul style="margin-left: -30px; width: 480px">
						<li><b>硬件环境：</b>Xeon E3 / DDR3 16GB / SSD </li>
						<li><b>软件环境：</b>Windows 10 pro x64 / JDK 1.7.0 / Mysql 5.7.10</li>
						<li><b>框架版本：</b>Rexdb-1.0.0-beta / Hibernate 5.1.0 Final / Mybatis 3.3.1</li>
					</ul>
				</div>
			</div>
		</div>
		
		
		<div class="row" style="margin-top: 20px; margin-bottom: 20px">
			<div class="col-md-6">
				<div id="overview-query" style="height: 350px"></div>
			</div>
			<div class="col-md-6">
				<div id="overview-update" style="height: 350px"></div>
			</div>
			<div class="col-md-12 text-right">
			* 根据软硬件环境的不同，您的测试结果可能与图示有所不同
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<h3>查询性能</h3>
				<p>查询性能取决于多方面因素，包括软硬件环境、需要读取的字段数量、映射对象类型、是否启用了优化选项等，我们按照查询结果分别进行了测试。</p>
			</div>
			<div class="col-md-6">
				<h4>对象</h4>
				<p>
					查询对象列表时，Rexdb全局配置中的“动态字节码”选项对性能影响显著，禁用后会降低查询性能。
				</p>
				
				<div id="getlist-dynamic" style="height: 300px"></div>
				
				<div id="getlist-reflect" style="height: 300px; margin-top: 30px"></div>
			</div>
			<div class="col-md-6">
				<h4>Map</h4>
				<p>
					查询Map列表会有一定的性能损耗。另外，在完成查询后并取值时，可能需要转换值的类型，因此还需要考虑转换过程中的性能损耗。
				</p>
				
				<div id="getmaplist" style="height: 300px"></div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<h3>更新性能</h3>
				<p>数据库的插入、修改和删除等均属于更新操作，以下以插入记录为例，更新性能测试结果如下。</p>
			</div>
			<div class="col-md-6">
				<div id="insert" style="height: 300px"></div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<h3>批量更新性能</h3>
				<p>
				与逐条更新记录相比，调用批量接口可以获得更高的性能。
				各框架的批量更新方式不同，所以测试结果也有着较大的差距，实现方式分别为：
				</p>
				<ul>
					<li><p><b>Hibernate</b>：在同一事物中提交多个插入操作；</p></li>
					<li><p><b>Mybatis</b>：生成并执行一个较长的插入SQL，一次提交所有的预编译参数；</p></li>
					<li><p><b>Rexdb</b>：调用JDBC的批量更新接口；</p></li>
				</ul>
				<p>需要注意的是，在某些数据库驱动中，可能需要开启相关选项才能真正实现真正的批量更新。
				例如，Mysql的JDBC驱动默认关闭了批量接口，需要在驱动连接字符中设置“rewriteBatchedStatements=true”才能实现高性能的批量操作。
				</p>
			</div>
			<div class="col-md-6">
				<div id="batch" style="height: 300px"></div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<h3>低配置服务器测试</h3>
				<p>我们还在低配置服务器中执行了性能测试，以下以<a href="#" 
					data-toggle="popover" data-placement="auto bottom" data-trigger="hover" title="树莓派（raspberry pi）卡式电脑系统" ref="#env-pi">树莓派（raspberry pi）卡式电脑系统</a>为例，主要测试结果如下：</p>
				<div id="env-pi" style="display: none">
					<ul style="margin-left: -30px">
						<li><b>硬件环境：</b>Raspberry Pi 2代B型 / Class10 TF Card</li>
						<li><b>软件环境：</b>CentOS 7 armv7hl 1511 / JDK 1.7.0 / MariaDB 5.5</li>
						<li><b>框架版本：</b>Rexdb-1.0.0-beta / Hibernate 5.1.0 Final / Mybatis 3.3.1</li>
					</ul>
				</div>
			</div>
			<div class="col-md-6">
				<div id="pi-insert" style="height: 300px"></div>
			</div>
			<div class="col-md-6">
				<div id="pi-getlist" style="height: 300px"></div>
			</div>
		</div>
		
	</div>

<? include_once('include/footer.php'); ?>
</body>
</html>
