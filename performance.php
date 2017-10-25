<!DOCTYPE html>
<html>
<head>
<title>性能 - Rexdb ORM</title>
<?php
$basePath = '';
include_once('include/import.php'); 
?>
<script>
$(document).ready(function(){
	$("a[data-toggle='popover']").popover({
		html: true,
		content: function(){
			return $($(this).attr('ref')).html();
		}
	});
	initPerformaceGraphics();
});
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
<?php
$activeMenu = 'performance';
include_once('include/navbar.php'); 
?>

<section id="header" class="top-div">
	<div class="container">	
		<div class="row" style="margin-top: 20px; margin-bottom: 30px">
			<div class="col-md-12">
				<h3>性能测试</h3>
				<br/>
				<p>
				在发布重要更新之前，Rexdb均会进行一系列的性能检测。
				</p>
				<p>
				性能检测的结果与软硬件环境、框架版本、配置选项、测试样本数量，甚至与执行测试时的系统空闲资源有关，可能存在较大误差。
				测试程序中的第三方框架和相关数据库均未进行优化，各项数值并不代表其真实能力。
				</p>
				<p>
				若无特殊说明，以下测试均运行于<a href="javascript:void(0)" data-toggle="popover" data-placement="auto bottom" data-trigger="hover" title="台式机电脑系统" ref="#env-pc">台式机电脑系统</a>，您可以下载Rexdb性能测试程序并在您的环境中运行，以获得相对准确的结果。
				</p>
				<div id="env-pc" style="display: none">
					<ul style="margin-left: -30px; width: 350px">
						<li><b>硬件环境：</b>Xeon E3 / DDR3 / SSD </li>
						<li><b>软件环境：</b>Windows 10 pro x64 / JDK 1.7.0</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="container">

		<div class="row" style="margin-bottom: 20px">
			<div class="col-md-12">
				<div class="bs-callout bs-callout-info">
    				<h4>查看测试结论</h4>
    				<p>
						<label class="checkbox-inline b"><input type="checkbox" id="rexdb" value="rexdb" checked="checked" disabled="disabled"> Rexdb 1.0.0</label>
						<label class="checkbox-inline b"><input type="checkbox" id="jdbc" value="jdbc" checked="checked" disabled="disabled"> JDBC</label>
						<label class="checkbox-inline b"><input type="checkbox" id="hibernate" name="framework" value="hibernate" checked="checked"> Hibernate 5.1.0</label>
						<label class="checkbox-inline b"><input type="checkbox" id="mybatis" name="framework" value="mybatis" checked="checked"> Mybatis 3.3.1</label>
						<label class="checkbox-inline b"><input type="checkbox" id="spring" name="framework" value="spring" checked="checked"> Spring jdbc 4.2.5</label>
    				</p>
    				<p>
    					<label class="radio-inline b"><input type="radio" id="oracle" name ="database" value="oracle" checked="checked">Oracle 10g</label>
						<label class="radio-inline"><input type="radio" id="mysql" name ="database" value="mysql">Mysql 5.7</label>
						<label class="radio-inline"><input type="radio" id="sqlserver" name ="database" value="sqlserver">SQL Server 2008</label>
						
						<label class="radio-inline"><input type="radio" id="postgresql" name ="database" value="postgresql">PostgreSQL 9.5</label>
						<label class="radio-inline"><input type="radio" id="db2" name ="database" value="db2">DB2 10.1</label>
						
						<label class="radio-inline"><input type="radio" id="h2" name ="database" value="h2">H2 1.4</label>
						<label class="radio-inline"><input type="radio" id="derby" name ="database" value="derby">Derby 10.12</label>
						<label class="radio-inline"><input type="radio" id="hsqldb" name ="database" value="hsqldb">Hsqldb 2.3</label>
						<br/>
    					<label class="radio-inline"><input type="radio" id="dm" name ="database" value="dm">达梦 7.1</label>
						<label class="radio-inline"><input type="radio" id="kingbase" name ="database" value="kingbase">金仓 7.1</label>
						<label class="radio-inline"><input type="radio" id="oscar" name ="database" value="oscar">神通 7.0 （Linux-x64）</label>
						<br/>
						<label class="radio-inline"><input type="radio" id="pi2" name ="database" value="pi2">MariaDB 5.5（Raspberry Pi 2B+ / Class10 TF Card / CentOS 7 / JDK 1.7.0）</label>
    				</p>
    				
  				</div>

  				<div id="tip" class="alert alert-warning alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <span class="glyphicon glyphicon glyphicon-warning-sign" aria-hidden="true"></span>
				  <span id="tip-html">rexdb-1.0.0 尚未对<b>H2</b>数据库中的CLOB字段进行优化处理，在查询时具有较高的性能损耗（其它类型字段不受影响），将在后续版本中改进。</span>
				</div>
			</div>
			
		</div>
		
		
		
		<div class="row" style="margin-top: 20px;">
			<div class="col-md-6">
				<div id="overview-query" style="height: 350px"></div>
			</div>
			<div class="col-md-6">
				<div id="overview-update" style="height: 350px"></div>
			</div>
			<div class="col-md-12 text-right">
			</div>
		</div>
		
		<div id="performance-query" class="row">
			<div class="col-md-12">
				<h3>查询性能</h3>
				<p>查询性能取决于多方面因素，包括软硬件环境、需要读取的字段数量、映射对象类型、是否启用了优化选项等，以下按照查询结果的类型分别进行测试。</p>
			</div>
			<div class="col-md-6">
				<h4>查询为对象</h4>
				<p>
					查询为对象时，Rexdb全局配置中的“动态字节码”选项对性能影响显著，禁用后会降低查询性能。
				</p>
				
				<div id="getlist-dynamic" style="height: 300px"></div>
				
				<div id="getlist-reflect" style="height: 300px; margin-top: 30px"></div>
			</div>
			<div class="col-md-6">
				<h4>查询为Map</h4>
				<p>
					与查询为对象相比，查询为Map会有更多的性能损耗。但这类接口适合处理复杂的结果集，可以在程序中适度使用。
				</p>
				
				<div id="getmaplist" style="height: 300px"></div>
			</div>
		</div>

		<div id="performance-update" class="row">
			<div class="col-md-12">
				<h3>更新性能</h3>
				<p>数据库的插入、修改、删除，以及执行DLL语句均属于更新操作。以下以插入为例，分别以Java对象和org.rex.db.Ps对象作为参数，进行性能测试。</p>
			</div>
			<div class="col-md-6">
				<h4>使用Java对象作参数</h4>
				<p>
					使用Java对象作参数会有轻微的性能损耗，“动态字节码”选项也不能带来显著的性能提升。
				</p>
				
				<div id="insert" style="height: 300px"></div>
			</div>
			<div class="col-md-6">
				<h4>使用Ps对象作参数</h4>
				<p>
					Ps对象和Java对象作参数的性能接近，均有轻微的性能损耗。除此之外，Map和数组做参数时的性能均类似。
				</p>
				
				<div id="insertps" style="height: 300px"></div>
			</div>
		</div>
		
		<div id="performance-batch" class="row">
			<div class="col-md-12">
				<h3>批量更新性能</h3>
				<p>
				与逐条更新相比，批量接口可以获得大幅的性能提升。通常可以使用以下几种方式实现批量更新：
				</p>
				<ul>
					<li><p>启用事物，并在同一个事物中提交多个操作；</p></li>
					<li><p>使用字符串拼接一个较长的SQL，一次提交所有的预编译参数；</p></li>
					<li><p>调用JDBC的批量更新接口；</p></li>
				</ul>
				<p>Rexdb批量更新类接口使用了第3种方式，但同时也支持其它批量更新方式。</p>
				<p>需要注意的是，在某些数据库驱动中，可能需要开启相关选项才能真正实现基于JDBC的批量更新操作。
				例如，Mysql的JDBC驱动默认关闭了批量接口，需要在驱动连接字符串中设置“rewriteBatchedStatements=true”开启。
				</p>
			</div>
			<div class="col-md-6">
				<div id="batch" style="height: 300px"></div>
			</div>
			<div class="col-md-6">
				<div id="batchps" style="height: 300px"></div>
			</div>
		</div>
		
		
	</div>

<?php include_once('include/footer.php'); ?>
</body>
</html>
