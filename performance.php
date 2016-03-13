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
				<h3>性能测试</h3>
				<p>我们执行了一系列检测，并且与同类框架进行了性能和其它方面的比较。完整的测试程序可以<a href="#">点击这里</a>下载。</p>
				<ul>
					<li><p><b>硬件环境：</b>Xeon E3-1231 / DDR3 16GB / Plextor M6S SSD </p></li>
					<li><p><b>软件环境：</b>Windows 10 pro x64 / JDK 1.7.0 / Mysql 5.7</p></li>
					<li><p><b>框架版本：</b>Rexdb-1.0.0-beta / Hibernate 5.1.0 Final / Mybatis 3.3.1</p></li>
				</ul>
			</div>
		</div>
		
		<div class="row" style="margin-top: 20px; margin-bottom: 20px">
			<div class="col-md-6">
				<div id="overview-performace" style="height: 350px"></div>
			</div>
			<div class="col-md-6">
				<div id="overview-code" style="height: 350px"></div>
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
					查询对象列表时，Rexdb全局配置中的“动态字节码”选项对性能影响最为明显，禁用后会降低查询性能。
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
				<h3>调用性能</h3>
				<p>——</p>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<h3>低配置服务器运行性能</h3>
				<p>我们还在低配置服务器中执行了性能测试，以下以树莓派（raspberry pi）卡式电脑为例，主要测试结果如下：</p>
				<ul>
					<li><p><b>硬件环境：</b>Raspberry Pi 2代B型 / Class10 TF 16GB</p></li>
					<li><p><b>软件环境：</b>CentOS 7 armv7hl 1511 / JDK 1.7.0 / MariaDB 5.5</p></li>
					<li><p><b>框架版本：</b>Rexdb-1.0.0-beta / Hibernate 5.1.0 Final / Mybatis 3.3.1</p></li>
				</ul>
			</div>
			<div class="col-md-6">
				<div id="pi-insert" style="height: 300px"></div>
			</div>
			<div class="col-md-6">
				<div id="pi-getlist" style="height: 300px"></div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<h3>声明</h3>
				<p>以上所有测试结论只代表某一次的测试结果，且测试结果与可能是不准确的，甚至与实际生产环境中有较大的偏差。
				且由于我们对Hibernate/Mybatis框架的使用水平有限，并未进行有针对性的优化，所以测试结果可能也是不准确的。
				</p>
				<p>以上测试结果仅供参考。</p>
			</div>
		</div>
	</div>

<? include_once('include/footer.php'); ?>
</body>
</html>
