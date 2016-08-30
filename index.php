<!DOCTYPE html>
<html lang="zh-cn" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Rexdb ORM</title>
<?
$basePath = './';
include_once('include/import.php'); 
?>
<script type="text/javascript">
var firedAni = {};
$(function(){
	var jqs = [$('#performance'), $('#typed-window'), $('#gears')];
	var callback = [initIndexGraphics, startTyped, runGears];
	
	$(window).bind('scroll', function () {
		for(var i=0;i<jqs.length;i++){
			var jq = jqs[i];
			var winH = $(window).height();
			var yJq = jq.offset().top;
			var hJq = jq.outerHeight();
			var top = $(window).scrollTop();
			if(!firedAni[i] && (top + winH > yJq+hJq) && (top < yJq)){
				firedAni[i] = true;
				try{
					callback[i]();
				}catch(e){}
			}
		}
	});

	$(window).scroll();
});
</script>
</head>
<body>
<? 
include_once('include/navbar.php'); 
?>
<section id="header" class="top-div">
<div class="container" >
	<div class="lead">
		<h1 align="center" id="dv">Rexdb是一个开源持久层框架</h1>
		<p>
		Rexdb是一款使用Java语言编写的，开放源代码的ORM持久层框架。
		它可以处理查询、更新、批处理、调用、事物和JTA事物等数据库操作，支持多种类型的对象作为预编译参数，并自动完成结果集到对象的映射。
		Rexdb具有功能全面、使用简单、性能良好等特点，适用于大多数开发场景。
		</p>
		<div style="margin-top: 50px; text-align:center"><a href="download/1.0/binary/rexdb-1.0.2.zip" class="btn-lg btn-primary btn-outline main-btn">下载最新版本 （rexdb-1.0.2）</a></div>
	</div>
</div>
</section>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h3>
				<span class="iconfont icon-orm" aria-hidden="true"></span>
				ORM
			</h3>
			<p>
				支持各类SQL，包括查询、更新、批处理、调用等，自动将结果集转换为Java对象。
			</p>
		</div>
		<div class="col-md-6">
			<h3>
				<span class="iconfont icon-assign" aria-hidden="true"></span>
				方言
			</h3>
			<p>
				内置数据库方言，屏蔽个性化SQL语句，便于开发跨数据库应用软件。
			</p>		
		</div>
	</div>	
	<div class="row">
		<div class="col-md-6">
			<h3>
				<span class="iconfont icon-job" aria-hidden="true"></span>
				监控
				</h3>
			<p>
				内置监听接口，可跟踪每个SQL和事物的执行过程。
			</p>
		</div>
		<div class="col-md-6">
			<h3>
				<span class="iconfont icon-plugin" aria-hidden="true"></span>
				兼容和扩展
			</h3>
			<p>
				多语言支持、兼容第三方数据源和日志实现，还可以自行扩展更多功能。
			</p>
		</div>
	</div>
</div>	

<section class="header-gray">
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
			无需配置，一行代码操作数据库。
			</p>			
		</div>
		<div class="col-md-6 thumbnail">
			<div id="typed-window" class="typed-window" style="height: 300px; position: relative ">
				<span id="student" class="iconfont icon-student student"></span>
				<span id="student-colored" class="iconfont icon-student student-colored" style="display: none"></span>
				<span class="student-equals">= </span>
				<span class="typed" id="typed"></span>
			</div>
		</div>
	</div>	
</div>

<section class="header-gray">
	<div class="container">
		<div class="row">
			<div class="col-md-6 thumbnail">
				<div id="gears" style="height: 300px; position: relative">
				
					<div id="gear-system-5">
						<div class="shadow" id="shadow12"></div>
						<div id="gear12"></div>
						<div class="shadow" id="shadow11"></div>
						<div id="gear11"></div>
						<div class="shadow" id="shadow8"></div>
						<div id="gear8"></div>
					</div>
					<div id="gear1"></div>
					
					<span class="native-sql" id="native-sql" style="display: none">Native SQL</span>
				</div>
			</div>
			<div class="col-md-6">
				<h2>不失灵活</h2>
				<p>支持原生SQL，不降低灵活度。</p>			
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


<section class="header-gray">
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
				<p>Rexdb在测试和试运行后才会发布版本，通常不会有严重问题。尽管如此，如果您发现了BUG，请<a href="feedback.php">点击此处反馈</a>。</p>
			</div>
			<div class="col-md-4">
				<span alt="bug" class="media-object iconfont icon-yijianfankui iconmain"></span>
				<h3>改进建议</h3>
				<p>如果您有任何意见和建议，请<a href="feedback.php">点击此处反馈</a>。</p>
			</div>
		</div>
	</div>
</section>
<? include_once('include/footer.php'); ?>
</body>
</html>