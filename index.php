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
		Rexdb是一款使用Java语言编写的，开放源代码的持久层框架。它可以处理查询、更新、批处理、函数和存储过程调用等数据库操作。
		它可以执行复杂的SQL语句，支持多种类型的对象作为预编译参数，并自动将执行结果转换为Map和自定义的对象。
		Rexdb具有接口设计灵活、使用简单、性能良好等特点，非常适合数据结构复杂、需要快速迭代或是对性能要求严苛的开发场景。
		</p>
		<div style="margin-top: 50px; text-align:center"><a href="/account/sign_up" class="btn-lg btn-primary btn-outline">下载最新版本 (v1.0.0-m1)</a></div>
	</div>
</div>
</section>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h2>特点</h2>
			<p>
			不需要编写繁琐的代码和映射文件，直接将SQL语句和Java对象传递至框架接口，即可获得需要的结果。 
			</p>			
		</div>
		<div class="col-md-6 thumbnail" style="height:220px">
			<img src="bootstrap/docs/assets/img/components.png" ></img>
		</div>
	</div>	
	<div class="row">
		<div class="col-md-6">
			<h3>功能</h3>
			<p>
				支持查询、更新、批处理、调用、事物和JTA事物等数据库操作，并自动进行结果集的O/R映射；
				还支持多数据源管理、数据库方言、监听、异常信息国际化等功能。
			</p>
		</div>
		<div class="col-md-6">
			<h3>接口</h3>
			<p>
				为方便调用，Rexdb的数据库操作接口都是静态，并且集中在一个类中。
				开发人员不需要耗费时间记忆繁琐的配置和使用方法，也不需要额外关注线程安全等问题。
			</p>		
		</div>
	</div>	
	<div class="row">
		<div class="col-md-6">
			<h3>性能</h3>
			<p>
				Rexdb使用了多种技术优化O/R映射性能，与直接调用JDBC接口相比，在执行查询、更新、调用等操作时的性能损耗极小，均在?%以内（需要启用相应的配置选项）。
			</p>
		</div>
		<div class="col-md-6">
			<h3>兼容性和扩展能力</h3>
			<p>
				内置Oracle、Mysql、SQLServer等10余种数据库方言，
				兼容多种类型的数据源和日志实现，
				还可以通过监听接口扩展更多功能。
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
				<h2>代码量与查询耗时</h2>
				<p>Rexdb力求通过最短的代码，实现最高的查询效率。</p>			
			</div>
		</div>	
	</div>
</section>


<div class="container">	
	<div class="row" style="margin-bottom: 0px; margin-top: 40px">
		<div class="col-md-12">
			<h2>开始使用</h2>
			<p>以下文档有助于您快速部署和使用Rexdb。</p>
			
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
		<div class="row support" style="margin-top: 60px;">
			<div class="col-md-4">
				<img alt="agreement" src="style/images/agreement.png" width="120" height="120"/>
				<h3>用户协议</h3>
				<p>Rexdb基于<a href="http://www.apache.org/licenses/LICENSE-2.0.html" target="_blank">Apache2.0协议</a>，是免费、开源的软件，您可以将其用于个人和商业用途。</p>
			</div>
			<div class="col-md-4">
				<img alt="agreement" src="style/images/agreement.png" width="120" height="120"/>
				<h3>发现BUG</h3>
				<p>在发布每一个版本前，我们都会进行完整的测试。尽管如此，如果您发现了BUG，请填写<a href="#">BUG反馈单</a>，或者发送邮件至<a href="#">技术支持邮箱</a>，我们会尽快处理。</p>
			</div>
			<div class="col-md-4">
				<img alt="agreement" src="style/images/agreement.png" width="120" height="120"/>
				<h3>改进建议</h3>
				<p>我们会不断完善和升级，如果您有任何改进建议，请<a href="#">告知我们</a>。</p>
			</div>
		</div>
	</div>
</section>
<? include_once('include/footer.php'); ?>
</body>
</html>