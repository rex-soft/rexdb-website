<!DOCTYPE html>
<html lang="zh-cn" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Rexdb</title>
<?
$basePath = './';
include_once('include/import.php'); 
?>
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
			<h3>查询和ORM</h3>
			<p>
				数据库查询、更新、批处理、调用、事物和JTA事物等，具备内置的连接池、数据源管理、方言、监听等功能。
			</p>
		</div>
		<div class="col-md-6">
			<h3>数据源管理</h3>
			<p>
				Rexdb的接口设计简洁，易于学习和使用。
			</p>		
		</div>
	</div>	
	<div class="row">
		<div class="col-md-6">
			<h3>数据库方言</h3>
			<p>
				Rexdb使用了多种技术优化查询效率，在各类数据库中均具备良好的性能。
			</p>
		</div>
		<div class="col-md-6">
			<h3>兼容性和扩展能力</h3>
			<p>
				内置包括国产数据库在内的10余种方言，兼容第三方数据源和日志包，还可以通过监听接口扩展更多功能。
			</p>
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
				<h2>开发效率</h2>
				<p>Rexdb具备同类框架无法比拟的开发效率。</p>			
			</div>
		</div>	
	</div>
</section>

<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h2>运行效率</h2>
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
	

<!-- 	<dl id="learning">
		<dt><a href="document/1.0/intro.php">简介 - Rexdb框架的功能和特点</a></dt><dd></dd>			
		<dt><a href="document/1.0/download.php" >下载 - 下载压缩包和编译源代码</a></dt><dd></dd>
		<dt><a href="document/1.0/download.php" >三分钟入门 - 如果您使用过其它持久层框架，请阅读本文档</a></dt><dd></dd>	
		<dt><a href="document/1.0/quick-start.php">快速入门 - 在最短的时间内学会安装、配置和使用Rexdb</a></dt><dd></dd>			
		<dt><a href="document/1.0/user-manual.php">用户手册 - 完整的开发人员参考文档，包含详细的示例、配置和接口说明</a></dt><dd></dd>
		<dt><a href="#">常见问题 - 我们搜集整理了一些使用Rexdb过程中经常遇到的问题和解决方法</a></dt><dd></dd>
		<dt><a href="#">API - Rexdb Java API文档</a></dt><dd></dd>
	</dl> -->
</div>


<section id="header2">
	<div class="container">
		<div class="row support" style="margin-top: 80px; margin-bottom: 120px;">
			<div class="col-md-4">
				<img alt="agreement" src="style/images/agreement.png" width="120" height="120"/>
				<h3>用户协议</h3>
				<p>Rexdb是开源软件，基于<a href="http://www.apache.org/licenses/LICENSE-2.0.html" target="_blank">Apache2.0协议</a>，您可以将其用于个人和商业用途。</p>
			</div>
			<div class="col-md-4">
				<img alt="agreement" src="style/images/agreement.png" width="120" height="120"/>
				<h3>发现BUG</h3>
				<p>Rexdb会在每次版本升级前进行测试，尽管如此，如果您发现了BUG，请<a href="#">点击此处反馈</a>。</p>
			</div>
			<div class="col-md-4">
				<img alt="agreement" src="style/images/agreement.png" width="120" height="120"/>
				<h3>改进建议</h3>
				<p>如果您有任何意见和建议，请<a href="#">点击此处反馈</a>。</p>
			</div>
		</div>
	</div>
</section>
<? include_once('include/footer.php'); ?>
</body>
</html>