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
<? include_once('include/navbar.php'); ?>
<section id="header" class="top-div">
<div class="container" >
	<div class="page-header lead">
		<h1 align="center" style="font-size: 50px;margin-bottom: 30px">Rexdb是一个开源持久层框架</h1>
		<p>
		Rexdb是一款使用Java语言编写的，开放源代码的持久层框架。它可以处理数据库查询、更新、批处理、函数和存储过程调用、事物和JTA事物等，
		可以使用多种类型的Java对象作为预编译参数，也可以自动将结果集转换为Map和Java对象。
		使用Rexdb时，不需要编写繁琐的代码和数据映射配置文件，将SQL语句和Java对象等参数传递至框架接口，即可获取需要的结果。 
		</p>
		<div style="margin-top: 30px; text-align:center"><a href="/account/sign_up" class="btn-lg btn-primary btn-outline">下载最新版本 (v1.0.0-m1)</a></div>
	</div>
</div>
</section>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h2>为什么需要rexdb？</h2>
			<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh,ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.Donec id elit non mi porta gravida at eget metus. </p>			
		</div>
		<div class="col-md-6 thumbnail" style="height:220px">
			<img src="bootstrap/docs/assets/img/components.png" ></img>
		</div>
	</div>	
	<div class="row">
		<div class="col-md-6">
			<h3>特性1</h3>
			<p>Our applications are completely self contained and bundle all of the libraries, databases, and runtimes required to run on any platform.</p>
		</div>
		<div class="col-md-6">
			<h3>特性2</h3>
			<p>Whenever vulnerabilities or serious security issues are discovered, we provide new versions of the apps as soon as possible, often within hours of the availability of a fix.</p>
		</div>
	</div>	
	<div class="row">
		<div class="col-md-6">
			<h3>特性3</h3>
			<p>We have automated processes to track the latest release of all of the applications we support and will provide a new version as soon as it becomes available.</p>
		</div>
		<div class="col-md-6">
			<h3>特性4</h3>
			<p>Our applications are configured optimally for most common scenarios out of the box. We fine tune compression and caching settings and bundle third-party technology like Google PageSpeed.</p>
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
				<h2>代码量与性能</h2>
				<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh,ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.Donec id elit non mi porta gravida at eget metus. </p>			
			</div>
		</div>	
	</div>
</section>


<div class="container">	
	<div class="row" style="margin-bottom: 0px">
		<div class="col-md-12">
			<h2>开始使用Rexdb</h2>
			<p> is used by millions of developers and business users all over the world, all the way from teaching themselves how to code to running non-profits to deploying and managing business-critical apps and servers. The following are some common use cases:</p>
		</div>
	</div>
	
<?
$docPath = 'document/1.0/';
include_once('document/1.0/_contents.php'); 
?>
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
		<div class="row" style="margin-bottom: 30px;">
			<div class="col-md-12">
			<h2>技术支持</h2>
			<p>Get started with a free plan or learn more about .</p>
			</div>
		</div>
		<div class="row" style="margin-top: 30px;">
			<div class="col-md-4">
				<div class="thumbnail" style="height:170px">
					<img alt="Cloud-icon" src="bootstrap/docs/assets/img/expo-riot.jpg" width="350" height="30"/>
					</div>
				<h3><a href="#">用户协议</a></h3>
				<p>Ready to get started? Download an app and install it locally, or launch a cloud server in minutes.</p>
			</div>
			<div class="col-md-4">
				<div class="thumbnail" style="height:170px">
					<img alt="Cloud-icon" src="bootstrap/docs/assets/img/expo-riot.jpg" width="350" height="30"/>
					</div>
					<h3><a href="#">发现BUG</a></h3>
					<p>Do you want to offer the  library to your cloud customers? Learn more about our Cloud Partner Program.</p>
				</div>
			<div class="col-md-4">
				<div class="thumbnail" style="height:170px">
					<img alt="Isv-icon" src="bootstrap/docs/assets/img/expo-riot.jpg" width="350" height="30"/>
				</div>
				<h3><a href="#">改进建议</a></h3>
				<p>Would you like to distribute your software to millions of users globally? Learn more about our Software Partner Program.</p>
			</div>
		</div>
	</div>
</section>
<? include_once('include/footer.php'); ?>
</body>
</html>