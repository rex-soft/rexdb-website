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
testResults.mysql = {"insert":{"rexdb":2427.77,"jdbc":2447.42,"hibernate":871.6,"mybatis":2341.73,"spring":2401.75},"insertPs":{"rexdb":2435.75,"jdbc":2480.73,"hibernate":862.95,"mybatis":2294.08,"spring":2370.35},"batchInsert":{"rexdb":42322.38,"jdbc":43804.5,"hibernate":29259.97,"mybatis":36004.48,"spring":36483.79},"batchInsertPs":{"rexdb":38642.65,"jdbc":43825.34,"hibernate":28435.85,"mybatis":36198.89,"spring":36014.95},"getList":{"rexdb":140536.6,"jdbc":146153.96,"hibernate":59354.68,"mybatis":77153.09,"spring":138027.3},"getList-disableDynamicClass":{"rexdb":128457.21,"jdbc":169201.17,"hibernate":64360.6,"mybatis":91983.48,"spring":138343.33},"getMapList":{"rexdb":120962.4,"jdbc":126020.5,"hibernate":110095.49,"mybatis":87846.94,"spring":83046.48}};//20160329
testResults.h2 = {"insert":{"rexdb":4231.63,"jdbc":4646.44,"hibernate":1242.16,"mybatis":3706.56,"spring":3953.29},"insertPs":{"rexdb":4340.21,"jdbc":4703.94,"hibernate":1532.33,"mybatis":4055.18,"spring":4360.54},"batchInsert":{"rexdb":8622.47,"jdbc":8927.83,"hibernate":6931.79,"mybatis":7904.66,"spring":8342.87},"batchInsertPs":{"rexdb":8531.47,"jdbc":8590.51,"hibernate":6964.48,"mybatis":7847.62,"spring":8074.42},"getList":{"rexdb":42904.08,"jdbc":44127.27,"hibernate":30526.46,"mybatis":32225.33,"spring":42809.49},"getList-disableDynamicClass":{"rexdb":39068.06,"jdbc":44301.39,"hibernate":29575.46,"mybatis":32566.42,"spring":44181.26},"getMapList":{"rexdb":39253.07,"jdbc":41218.01,"hibernate":37974.52,"mybatis":32563.32,"spring":32281.92}}; 
testResults.postgresql={"insert":{"rexdb":2495.19,"jdbc":2504.69,"hibernate":1243.42,"mybatis":2236.2,"spring":1582.27},"insertPs":{"rexdb":2713.02,"jdbc":2542.56,"hibernate":1312.35,"mybatis":2619.13,"spring":1549.62},"batchInsert":{"rexdb":16664.95,"jdbc":16861.99,"hibernate":15555.33,"mybatis":16005.13,"spring":3928.56},"batchInsertPs":{"rexdb":16384.68,"jdbc":16755.16,"hibernate":15817.72,"mybatis":16056.13,"spring":3909.84},"getList":{"rexdb":121268.9,"jdbc":130431.11,"hibernate":51713.31,"mybatis":72537.33,"spring":94581.25},"getList-disableDynamicClass":{"rexdb":100540.63,"jdbc":164024.06,"hibernate":52070.23,"mybatis":81134.21,"spring":94065.03},"getMapList":{"rexdb":101411.22,"jdbc":121183.97,"hibernate":91340.49,"mybatis":70785.26,"spring":70401.8}}
testResults.derby={"insert":{"rexdb":1563.15,"jdbc":1742.7,"hibernate":0,"mybatis":0,"spring":1542.73},"insertPs":{"rexdb":1657.65,"jdbc":1740.5,"hibernate":0,"mybatis":0,"spring":1665.64},"batchInsert":{"rexdb":12797.72,"jdbc":12794.34,"hibernate":0,"mybatis":0,"spring":12404.35},"batchInsertPs":{"rexdb":12576.55,"jdbc":12502,"hibernate":0,"mybatis":0,"spring":12270.56},"getList":{"rexdb":8335.68,"jdbc":8380.58,"hibernate":0,"mybatis":0,"spring":8459.89},"getList-disableDynamicClass":{"rexdb":8210.19,"jdbc":8544.63,"hibernate":0,"mybatis":0,"spring":8488.53},"getMapList":{"rexdb":8319.7,"jdbc":8312.03,"hibernate":0,"mybatis":0,"spring":8223.39}};
testResults.hsqldb={"insert":{"rexdb":3782.54,"jdbc":4176.54,"hibernate":1680.04,"mybatis":3096.73,"spring":3933.32},"insertPs":{"rexdb":5264.31,"jdbc":5324.3,"hibernate":3149.39,"mybatis":3900.14,"spring":5206.27},"batchInsert":{"rexdb":182980.56,"jdbc":174466.69,"hibernate":67869.24,"mybatis":129850.72,"spring":179767.42},"batchInsertPs":{"rexdb":160713.43,"jdbc":200481.73,"hibernate":124639.84,"mybatis":116095.48,"spring":193596.74},"getList":{"rexdb":495486.78,"jdbc":480205.93,"hibernate":240487.12,"mybatis":297032.03,"spring":523321.66},"getList-disableDynamicClass":{"rexdb":484881.82,"jdbc":547459.79,"hibernate":251269.04,"mybatis":397917.33,"spring":555738.54},"getMapList":{"rexdb":492261.66,"jdbc":419311.26,"hibernate":388148.66,"mybatis":378964.55,"spring":284008.24}};
testResults.dm={"insert":{"rexdb":2888.22,"jdbc":3618.27,"hibernate":1223.47,"mybatis":2443.85,"spring":3075.16},"insertPs":{"rexdb":3663.49,"jdbc":3659.49,"hibernate":2558.83,"mybatis":2924.69,"spring":4123.02},"batchInsert":{"rexdb":39838.26,"jdbc":39341.18,"hibernate":25381.85,"mybatis":32453.34,"spring":32774.53},"batchInsertPs":{"rexdb":29552.09,"jdbc":32400.5,"hibernate":22629.48,"mybatis":26054.78,"spring":29020.4},"getList":{"rexdb":94329.94,"jdbc":108671.38,"hibernate":45449.89,"mybatis":41979.04,"spring":102796.2},"getList-disableDynamicClass":{"rexdb":71188.69,"jdbc":97138.29,"hibernate":45025.37,"mybatis":43925.93,"spring":103484.2},"getMapList":{"rexdb":63914.24,"jdbc":89808.17,"hibernate":49920.02,"mybatis":48229.27,"spring":37303.34}};
testResults.sqlserver={"insert":{"rexdb":1371.6,"jdbc":1205.7,"hibernate":640.77,"mybatis":0,"spring":1427.65},"insertPs":{"rexdb":1439.59,"jdbc":1460.67,"hibernate":754.99,"mybatis":0,"spring":1402.7},"batchInsert":{"rexdb":33589.66,"jdbc":32076.68,"hibernate":28988.83,"mybatis":0,"spring":30625.4},"batchInsertPs":{"rexdb":32712.19,"jdbc":35554.18,"hibernate":30046.49,"mybatis":0,"spring":30482.16},"getList":{"rexdb":121765.41,"jdbc":105907.04,"hibernate":58330.79,"mybatis":0,"spring":104680.53},"getList-disableDynamicClass":{"rexdb":87715.66,"jdbc":101613.39,"hibernate":55839.87,"mybatis":0,"spring":99678.89},"getMapList":{"rexdb":89721.79,"jdbc":87511.13,"hibernate":101229.7,"mybatis":0,"spring":66110.28}}
testResults.oracle={"insert":{"rexdb":1440.52,"jdbc":1481.36,"hibernate":795.09,"mybatis":1388.04,"spring":1460.16},"insertPs":{"rexdb":1491.32,"jdbc":1560.89,"hibernate":1077.59,"mybatis":1298.46,"spring":1519.77},"batchInsert":{"rexdb":16947.57,"jdbc":20611.03,"hibernate":10024.1,"mybatis":19346.02,"spring":11767.29},"batchInsertPs":{"rexdb":19155.08,"jdbc":18560.56,"hibernate":12385.09,"mybatis":19683.07,"spring":12668.77},"getList":{"rexdb":52666.79,"jdbc":52001.62,"hibernate":32401.95,"mybatis":35031.98,"spring":50686.86},"getList-disableDynamicClass":{"rexdb":45718.49,"jdbc":49851.14,"hibernate":33934.62,"mybatis":35277.71,"spring":50722.71},"getMapList":{"rexdb":41203.33,"jdbc":47743.36,"hibernate":38303.09,"mybatis":34921.25,"spring":29596.62}};
testResults.db2={"insert":{"rexdb":1633.47,"jdbc":1660.74,"hibernate":1169.58,"mybatis":0,"spring":1807.45},"insertPs":{"rexdb":1861.12,"jdbc":1818.23,"hibernate":1388.94,"mybatis":0,"spring":1831.62},"batchInsert":{"rexdb":32914.27,"jdbc":36790.34,"hibernate":36721.65,"mybatis":0,"spring":39229.75},"batchInsertPs":{"rexdb":34377.57,"jdbc":35155.26,"hibernate":29850.07,"mybatis":0,"spring":30797.86},"getList":{"rexdb":48718.05,"jdbc":48919.46,"hibernate":35254.94,"mybatis":0,"spring":31098.44},"getList-disableDynamicClass":{"rexdb":44071.91,"jdbc":50897.44,"hibernate":27070.93,"mybatis":0,"spring":42152.06},"getMapList":{"rexdb":40130.67,"jdbc":42996.57,"hibernate":32639.91,"mybatis":0,"spring":35707.26}};
testResults.kingbase={"insert":{"rexdb":1096.67,"jdbc":1078.24,"hibernate":634.09,"mybatis":1019.08,"spring":1031},"insertPs":{"rexdb":1081.36,"jdbc":1124.9,"hibernate":747.27,"mybatis":1088.56,"spring":1046.87},"batchInsert":{"rexdb":31000.67,"jdbc":31903.24,"hibernate":21308.36,"mybatis":29436.77,"spring":30059.05},"batchInsertPs":{"rexdb":28117.19,"jdbc":30727.26,"hibernate":22960.61,"mybatis":27874.41,"spring":28832.12},"getList":{"rexdb":57253.03,"jdbc":76890.47,"hibernate":45662.36,"mybatis":40647.13,"spring":79706.92},"getList-disableDynamicClass":{"rexdb":52174.87,"jdbc":78295.86,"hibernate":45942.85,"mybatis":41073.83,"spring":80344.5},"getMapList":{"rexdb":50732.98,"jdbc":60408.27,"hibernate":56829.3,"mybatis":44510.42,"spring":39445.1}};
testResults.oscar={"insert":{"rexdb":830.96,"jdbc":848.27,"hibernate":842.47,"mybatis":1076.53,"spring":870.67},"insertPs":{"rexdb":852.28,"jdbc":861.99,"hibernate":858.82,"mybatis":1079.95,"spring":861.89},"batchInsert":{"rexdb":74906.46,"jdbc":103307.35,"hibernate":68141.62,"mybatis":74533.71,"spring":101555.84},"batchInsertPs":{"rexdb":84255.81,"jdbc":87474.76,"hibernate":57157.28,"mybatis":59640.81,"spring":81990.92},"getList":{"rexdb":32782.35,"jdbc":32707.47,"hibernate":28796.64,"mybatis":32177.05,"spring":33625.36},"getList-disableDynamicClass":{"rexdb":32214.42,"jdbc":33133.41,"hibernate":28545.87,"mybatis":31932.29,"spring":33476.23},"getMapList":{"rexdb":32422.54,"jdbc":32321.29,"hibernate":31334.83,"mybatis":31737.07,"spring":31726.87}};


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
				对于Rexdb的每个重要版本，均会进行一系列的性能检测。
				</p>
				<p>
				性能检测的结果与软硬件环境、框架版本、配置选项、测试样本数量，甚至与执行测试时的系统空闲资源有关，可能存在较大误差，仅作为Rexdb框架性能的参考。
				在测试中的使用的第三方框架和数据库均未进行有针对性的优化，各项数据并不能代表其真实能力。
				若无特殊说明，以下测试均运行于<a href="#" data-toggle="popover" data-placement="auto bottom" data-trigger="hover" title="台式机电脑系统" ref="#env-pc">台式机电脑系统</a>，是某一次执行测试程序的结果。
				您可以<a href="#">下载测试程序</a>并在您的环境中运行，以获得相对准确的结果。
				</p>
				<p>
				需要注意的是，以下各持久层框架均封装了JDBC接口，因此理论上性能不会好于直接调用JDBC。如果测试结果中出现了例外，一般是因误差所致。
				</p>
				<div id="env-pc" style="display: none">
					<ul style="margin-left: -30px; width: 350px">
						<li><b>硬件环境：</b>Xeon E3 / DDR3 / SSD </li>
						<li><b>软件环境：</b>Windows 10 pro x64 / JDK 1.7.0</li>
					</ul>
				</div>
				<div class="bs-callout bs-callout-info">
    				<h4>查看测试结论（<a  id="showall" href="javascript:void(0)">显示全部框架</a>）</h4>
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
	    					<label class="radio-inline"><input type="radio" id="oracle" name ="database" value="oracle">Oracle 10g</label>
	    					<label class="radio-inline"><input type="radio" id="sqlserver" name ="database" value="sqlserver">SQL Server 2008</label>
							<label class="radio-inline"><input type="radio" id="db2" name ="database" value="db2">DB2 10.1</label>
							<label class="radio-inline"><input type="radio" id="mysql" name ="database" value="mysql" checked="checked">Mysql 5.7</label>
							<label class="radio-inline"><input type="radio" id="postgresql" name ="database" value="postgresql">Postgresql 9.5</label>
							<label class="radio-inline"><input type="radio" id="hsqldb" name ="database" value="hsqldb">Hsqldb 2.3</label>
							<label class="radio-inline"><input type="radio" id="h2" name ="database" value="h2">H2 1.4</label>
							<label class="radio-inline"><input type="radio" id="derby" name ="database" value="derby">Derby 10.12</label>
							<br/>
	    					<label class="radio-inline"><input type="radio" id="dm" name ="database" value="dm">达梦 7.1</label>
							<label class="radio-inline"><input type="radio" id="kingbase" name ="database" value="kingbase">金仓 7.1</label>
							<label class="radio-inline"><input type="radio" id="oscar" name ="database" value="oscar">神通 7.0 (Ubuntu 15.1)</label>
    				</p>
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
