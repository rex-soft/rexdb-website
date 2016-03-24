<!DOCTYPE html>
<html>
<head>
<title>性能 - Rexdb</title>
<?
$basePath = '';
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

var testResults = [];
testResults.mysql = {"insert":{"rexdb":388.63,"jdbc":391.78,"hibernate":268.53,"mybatis":399.38,"spring":405.83},"insertPs":{"rexdb":409.31,"jdbc":421.86,"hibernate":309.22,"mybatis":408.26,"spring":419.51},"batchInsert":{"rexdb":37140.64,"jdbc":39253.81,"hibernate":26377.43,"mybatis":32205.82,"spring":33675.81},"batchInsertPs":{"rexdb":36305,"jdbc":38859.23,"hibernate":26630.06,"mybatis":32110.28,"spring":33935.79},"getList":{"rexdb":135323.36,"jdbc":115784.64,"hibernate":54927.82,"mybatis":70004.24,"spring":107648.35},"getList-disableDynamicClass":{"rexdb":126041.82,"jdbc":146807.06,"hibernate":64354.03,"mybatis":76905.21,"spring":144454.29},"getMapList":{"rexdb":121254.06,"jdbc":100083.89,"hibernate":107899.85,"mybatis":84324.14,"spring":76343.2}};
testResults.h2 = {"insert":{"rexdb":4231.63,"jdbc":4646.44,"hibernate":1242.16,"mybatis":3706.56,"spring":3953.29},"insertPs":{"rexdb":4340.21,"jdbc":4703.94,"hibernate":1532.33,"mybatis":4055.18,"spring":4360.54},"batchInsert":{"rexdb":8622.47,"jdbc":8927.83,"hibernate":6931.79,"mybatis":7904.66,"spring":8342.87},"batchInsertPs":{"rexdb":8531.47,"jdbc":8590.51,"hibernate":6964.48,"mybatis":7847.62,"spring":8074.42},"getList":{"rexdb":42904.08,"jdbc":44127.27,"hibernate":30526.46,"mybatis":32225.33,"spring":42809.49},"getList-disableDynamicClass":{"rexdb":39068.06,"jdbc":44301.39,"hibernate":29575.46,"mybatis":32566.42,"spring":44181.26},"getMapList":{"rexdb":39253.07,"jdbc":41218.01,"hibernate":37974.52,"mybatis":32563.32,"spring":32281.92}}; 
testResults.postgresql={"insert":{"rexdb":2495.19,"jdbc":2504.69,"hibernate":1243.42,"mybatis":2236.2,"spring":1582.27},"insertPs":{"rexdb":2713.02,"jdbc":2542.56,"hibernate":1312.35,"mybatis":2619.13,"spring":1549.62},"batchInsert":{"rexdb":16664.95,"jdbc":16861.99,"hibernate":15555.33,"mybatis":16005.13,"spring":3928.56},"batchInsertPs":{"rexdb":16384.68,"jdbc":16755.16,"hibernate":15817.72,"mybatis":16056.13,"spring":3909.84},"getList":{"rexdb":121268.9,"jdbc":130431.11,"hibernate":51713.31,"mybatis":72537.33,"spring":94581.25},"getList-disableDynamicClass":{"rexdb":100540.63,"jdbc":164024.06,"hibernate":52070.23,"mybatis":81134.21,"spring":94065.03},"getMapList":{"rexdb":101411.22,"jdbc":121183.97,"hibernate":91340.49,"mybatis":70785.26,"spring":70401.8}}
testResults.derby={"insert":{"rexdb":1563.15,"jdbc":1742.7,"hibernate":0,"mybatis":0,"spring":1542.73},"insertPs":{"rexdb":1657.65,"jdbc":1740.5,"hibernate":0,"mybatis":0,"spring":1665.64},"batchInsert":{"rexdb":12797.72,"jdbc":12794.34,"hibernate":0,"mybatis":0,"spring":12404.35},"batchInsertPs":{"rexdb":12576.55,"jdbc":12502,"hibernate":0,"mybatis":0,"spring":12270.56},"getList":{"rexdb":8335.68,"jdbc":8380.58,"hibernate":0,"mybatis":0,"spring":8459.89},"getList-disableDynamicClass":{"rexdb":8210.19,"jdbc":8544.63,"hibernate":0,"mybatis":0,"spring":8488.53},"getMapList":{"rexdb":8319.7,"jdbc":8312.03,"hibernate":0,"mybatis":0,"spring":8223.39}};

	var testResultPi = {
		    "insert": {
		        "rexdb": 424.43,
		        "jdbc": 425.81,
		        "hibernate": 308.77,
		        "mybatis": 416.14,
		        "spring": 412.39
		    },
		    "insertPs": {
		        "rexdb": 422.71,
		        "jdbc": 429.52,
		        "hibernate": 308.04,
		        "mybatis": 429.82,
		        "spring": 418.2
		    },
		    "batchInsert": {
		        "rexdb": 41685.48,
		        "jdbc": 42464.46,
		        "hibernate": 28349.99,
		        "mybatis": 34476.77,
		        "spring": 36615.6
		    },
		    "batchInsertPs": {
		        "rexdb": 36982.52,
		        "jdbc": 39608.39,
		        "hibernate": 26391.94,
		        "mybatis": 32015.82,
		        "spring": 33937.33
		    },
		    "getList": {
		        "rexdb": 105148.03,
		        "jdbc": 99283.86,
		        "hibernate": 45355.86,
		        "mybatis": 55912.52,
		        "spring": 97885.09
		    },
		    "getList-disableDynamicClass": {
		        "rexdb": 121310.21,
		        "jdbc": 153370.58,
		        "hibernate": 64887.03,
		        "mybatis": 84423.43,
		        "spring": 154554.5
		    },
		    "getMapList": {
		        "rexdb": 132920,
		        "jdbc": 121131.36,
		        "hibernate": 107455.76,
		        "mybatis": 84687.86,
		        "spring": 84359.46
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
				由于Rexdb封装了JDBC,并且扩展了额外的功能，因此理论上性能不会好于直接调用JDBC接口。虽然如此，但我们会通过代码优化，尽可能的降低不必要的性能损耗。
				</p>
				<p>
				性能测试结果与软硬件环境、框架版本、优化配置选项，甚至和测试时的系统空闲资源相关，并不是每一次测试都能得出相同的结论，但可以作为性能对比的参考。
				以下均为某一次的测试结果，具体数值可能是不准确的，与您自行测试的结果也可能有较大的偏差。
				您可以自行运行测试程序，以获得准确的数值。
				我们的测试环境为<a href="#" data-toggle="popover" data-placement="auto bottom" data-trigger="hover" title="台式机电脑系统" ref="#env-pc">台式机电脑系统</a>，完整的测试程序请<a href="#">点击这里</a>下载。
				</p>
				<p>
				测试程序中的Hibernate等第三方框架并未进行有针对性的优化，因此它们的测试结果仅供参考。默认图示中没有显示这些框架的性能，您可以从下面选择查看。
				</p>
				<div class="bs-callout bs-callout-info">
    				<h4>查看测试结论（<a  id="showall" href="#">全部显示</a>）</h4>
    				<p>
						<label class="checkbox-inline">
						  <input type="checkbox" id="rexdb" value="rexdb" checked="checked" disabled="disabled"> Rexdb 1.0.0-beta
						</label>
						<label class="checkbox-inline">
						  <input type="checkbox" id="jdbc" value="jdbc" checked="checked" disabled="disabled"> JDBC
						</label>
						<label class="checkbox-inline">
						  <input type="checkbox" id="hibernate" name="framework" value="hibernate"> Hibernate 5.1.0
						</label>
						<label class="checkbox-inline">
						  <input type="checkbox" id="mybatis" name="framework" value="mybatis"> Mybatis 3.3.1
						</label>
						<label class="checkbox-inline">
						  <input type="checkbox" id="spring" name="framework" value="spring"> Spring jdbc 4.2.5
						</label>
    				</p>
    				<p>
						<label class="radio-inline">
						  <input type="radio" id="mysql" name ="database" value="mysql" checked="checked"> Mysql 5.7
						</label>
						<label class="radio-inline">
						  <input type="radio" id="h2" name ="database" value="h2"> h2 1.4
						</label>
						<label class="radio-inline">
						  <input type="radio" id="postgresql" name ="database" value="postgresql"> Postgresql 9.5
						</label>
						<label class="radio-inline">
						  <input type="radio" id="derby" name ="database" value="derby"> Derby 10.12
						</label>
    				</p>
  				</div>
				
				<div id="env-pc" style="display: none">
					<ul style="margin-left: -30px; width: 480px">
						<li><b>硬件环境：</b>Xeon E3 / DDR3 / SSD </li>
						<li><b>软件环境：</b>Windows 10 pro x64 / JDK 1.7.0 / Mysql 5.7.10</li>
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
				<p>数据库的插入、修改和删除等均属于更新操作，Rexdb除了支持Java对象和Map作为执行SQL的参数外，还支持数组、Ps对象等。
				以下以插入记录为例，分别使用Java对象和org.rex.db.Ps对象进行性能测试。</p>
			</div>
			<div class="col-md-6">
				<h4>使用Java对象作为参数</h4>
				<p>
					使用Java对象、Map作参数时，Rexdb会有轻微的性能损耗，“动态字节码”选项也不能带来显著的性能提升。
				</p>
				
				<div id="insert" style="height: 300px"></div>
			</div>
			<div class="col-md-6">
				<h4>使用Ps对象作为参数</h4>
				<p>
					使用Ps对象、数组作参数时，Rexdb将不再需要数据表对应的Java对象，因此更加灵活，同时也不会带来明显的性能损耗。
				</p>
				
				<div id="insertps" style="height: 300px"></div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<h3>批量更新性能</h3>
				<p>
				与逐条更新记录相比，调用批量接口可以获得大幅的性能提升。通常可以使用以下几种方式实现批量更新：
				</p>
				<ul>
					<li><p>在同一个事物中提交多个更新操作；</p></li>
					<li><p>生成并执行一个较长的插入SQL，一次提交所有的预编译参数；</p></li>
					<li><p>调用JDBC的批量更新接口；</p></li>
				</ul>
				<p>Rexdb调用了JDBC的批量更新接口完成操作，但也支持其它批量更新方式。</p>
				<p>需要注意的是，在某些数据库驱动中，可能需要开启相关选项才能真正实现真正的批量更新。
				例如，Mysql的JDBC驱动默认关闭了批量接口，需要在驱动连接字符中设置“rewriteBatchedStatements=true”才能实现高性能的批量操作。
				</p>
			</div>
			<div class="col-md-6">
				<div id="batch" style="height: 300px"></div>
			</div>
			<div class="col-md-6">
				<div id="batchps" style="height: 300px"></div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<h3>低配置设备测试</h3>
				<p>我们还在低配置服务器中执行了性能测试，以下以<a href="#" 
					data-toggle="popover" data-placement="auto bottom" data-trigger="hover" title="树莓派（raspberry pi）卡式电脑系统" ref="#env-pi">树莓派（raspberry pi）卡式电脑系统</a>为例，主要测试结果如下：</p>
				<div id="env-pi" style="display: none">
					<ul style="margin-left: -30px">
						<li><b>硬件环境：</b>Raspberry Pi 2代B型 / Class10 TF Card</li>
						<li><b>软件环境：</b>CentOS 7 armv7hl 1511 / JDK 1.7.0 / MariaDB 5.5</li>
					</ul>
				</div>
			</div>
			<div class="col-md-6">
				<div id="pi-getlist" style="height: 300px"></div>
			</div>
			<div class="col-md-6">
				<div id="pi-insert" style="height: 300px"></div>
			</div>
		</div>
		
	</div>

<? include_once('include/footer.php'); ?>
</body>
</html>
