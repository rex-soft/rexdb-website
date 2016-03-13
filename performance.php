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
				<p>我们执行了一系列检测，并且与同类框架进行了性能和其它方面的比较。</p>
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
				<p>与逐条写入记录相比，分批提交数据可以获得更好的性能。</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<h3>调用性能</h3>
				<p>——</p>
			</div>
		</div>

	</div>

<? include_once('include/footer.php'); ?>
</body>
</html>
