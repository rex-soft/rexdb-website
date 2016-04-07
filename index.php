<!DOCTYPE html>
<html lang="zh-cn" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Rexdb</title>
<?
$basePath = './';
include_once('include/import.php'); 
?>
<script type="text/javascript" src="<?=$basePath?>style/highcharts-4.2.3/highcharts.js"></script>
<script type="text/javascript" src="<?=$basePath?>style/highcharts-4.2.3/highcharts-3d.js"></script>
<script type="text/javascript" src="<?=$basePath?>style/performance-1.0.0.js"></script>
<script>
$(document).ready(function(){
	initIndexGraphics();
});
</script>
</head>
<body>
<? 
include_once('include/navbar.php'); 
?>
<section id="header" class="top-div">
<div class="container" >
	<div class="page-header lead">
		<h1 align="center" style="font-size: 50px;margin-bottom: 30px">Rexdb是一个开源持久层框架</h1>
		<p>
		Rexdb是一款使用Java语言编写的，开放源代码的ORM持久层框架。
		它可以处理查询、更新、批处理、调用、事物和JTA事物等数据库操作，支持多种类型的对象作为预编译参数，并自动完成结果集到对象的映射。
		Rexdb具有功能全面、使用简单、性能良好等特点，非常适合数据结构和SQL语句复杂、需要快速实现的开发场景。
		</p>
		<div style="margin-top: 50px; text-align:center"><a href="/account/sign_up" class="btn-lg btn-primary btn-outline">下载最新版本 (v1.0.0-m1)</a></div>
	</div>
</div>
</section>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h3>ORM</h3>
			<p>
				支持各类SQL，包括查询、更新、批处理、调用等，自动将结果集转换为Java对象。
			</p>
		</div>
		<div class="col-md-6">
			<h3>方言</h3>
			<p>
				内置数据库方言，屏蔽个性化SQL语句，便于开发跨数据库应用软件。
			</p>		
		</div>
	</div>	
	<div class="row">
		<div class="col-md-6">
			<h3>监控</h3>
			<p>
				内置监听接口，可跟踪每个SQL和事物的执行过程。
			</p>
		</div>
		<div class="col-md-6">
			<h3>兼容和扩展</h3>
			<p>
				多语言支持、兼容第三方数据源和日志实现，还可以自行扩展更多功能。
			</p>
		</div>
	</div>
</div>	

<section id="header2">
	<div class="container">
		<div class="row">
			<div class="col-md-6 thumbnail">
				<div id="performance" style="height: 300px"></div>
			</div>
			<div class="col-md-6">
				<h2>高效运行</h2>
				<p>极低的性能损耗，优于同类框架。</p>			
			</div>
		</div>	
	</div>
</section>

<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h2>快速开发</h2>
			<p>
			Rexdb使用了多种技术优化查询效率，在各类数据库中均具备良好的性能。
			</p>			
		</div>
		<div class="col-md-6 thumbnail" style="height:300px">
			<img src="bootstrap/docs/assets/img/components.png" ></img>
		</div>
	</div>	
</div>

<section id="header2">
	<div class="container">
		<div class="row">
			<div class="col-md-6 thumbnail" style="height:300px">
				<img src="#"></img>
			</div>
			<div class="col-md-6">
				<h2>不失灵活</h2>
				<p>Rexdb具备同类框架无法比拟的开发效率。</p>			
			</div>
		</div>	
	</div>
</section>

<div class="container">	
	<div class="row" style="margin-bottom: 0px; margin-top: 40px">
		<div class="col-md-12">
			<h2>继续了解</h2>

			<?
			$docPath = 'document/1.0/';
			include_once('document/1.0/_contents.php'); 
			?>
		</div>
	</div>
</div>


<section id="header2">
	<div class="container">
		<div class="row support" style="margin-top: 80px; margin-bottom: 120px;">
			<div class="col-md-4">
				<span alt="agreement" class="media-object iconfont icon-3pingtaixieyi iconmain"></span>
				<h3>用户协议</h3>
				<p>Rexdb是开源软件，基于<a href="http://www.apache.org/licenses/LICENSE-2.0.html" target="_blank">Apache2.0协议</a>，您可以将其用于个人和商业用途。</p>
			</div>
			<div class="col-md-4">
				<span alt="bug" class="media-object iconfont icon-5ca6292aappcrash iconmain"></span>
				<h3>发现BUG</h3>
				<p>Rexdb会对每个版本进行测试，尽管如此，如果您发现了BUG，请<a href="#">点击此处反馈</a>。</p>
			</div>
			<div class="col-md-4">
				<span alt="bug" class="media-object iconfont icon-yijianfankui iconmain" style="font-size: 100px; height: 110px; margin-top: 10px"></span>
				<h3>改进建议</h3>
				<p>如果您有任何意见和建议，请<a href="#">点击此处反馈</a>。</p>
			</div>
		</div>
	</div>
</section>
<? include_once('include/footer.php'); ?>
</body>
</html>