<!DOCTYPE html>
<html>
<head>
<title>下载 - Rexdb</title>
<?
$basePath = '';
include_once('include/import.php'); 
?>
<style>
p {
	font-size: 16px;
}
blockquote{
	font-size: 15.5px;
}
li {
    list-style-type: disc;
}
</style>
</head>
<body>
<? 
$activeMenu = 'download';
include_once('include/navbar.php'); 
?>

<section id="header" class="top-div">
	<div class="container">	
		<div class="row" style="margin-top: 0; margin-bottom: 50px">
			<div class="col-md-12">
				<h3>下载</h3>
				<br/>
				<p>
				在发布重要更新之前，Rexdb均会进行一系列的性能检测。
				</p>
			</div>
		</div>
	</div>
</section>

<div class="container">
	<div class="row" style="margin-top: 20px; margin-bottom: 20px">
		<div class="col-md-12">
			<h3>稳定版本</h3>
			<p>编译好的包：</p>
			<ul>
				<li><p><a href="#"><b>rexdb-1.0.0.zip</b></a>（<a href="#">pgp</a>, <a href="#">md5</a>, <a href="#">sha1</a>）</p></li>
				<li><p><a href="#"><b>rexdb-1.0.0.tar.gz</b></a>（<a href="#">pgp</a>, <a href="#">md5</a>, <a href="#">sha1</a>）</p></li>
			</ul>
			
			<p>源代码：</p>
			<ul>
				<li><p><a href="#">rexdb-source-1.0.0.zip</a>（<a href="#">pgp</a>, <a href="#">md5</a>, <a href="#">sha1</a>）</p></li>
				<li><p><a href="#">rexdb-source-1.0.0.tar.gz</a>（<a href="#">pgp</a>, <a href="#">md5</a>, <a href="#">sha1</a>）</p></li>
			</ul>
			<p>测试程序：</p>
			<ul>
				<li><p><a href="#">rexdb-tester-1.0.0.zip</a>（<a href="#">pgp</a>, <a href="#">md5</a>, <a href="#">sha1</a>）</p></li>
				<li><p><a href="#">rexdb-tester-1.0.0.tar.gz</a>（<a href="#">pgp</a>, <a href="#">md5</a>, <a href="#">sha1</a>）</p></li>
			</ul>
		</div>
	</div>
	
	<div class="row" style="margin-top: 20px; margin-bottom: 20px">
		<div class="col-md-12">
			<h3>Github库</h3>
			<p>Rexdb的代码托管在Github库中，您可以下载到几所有版本的源文件。</p>
			<pre>clone https://github.com/rex-soft/rexdb.git</pre>
		</div>
	</div>
	
	<div class="row" style="margin-top: 20px; margin-bottom: 20px">
		<div class="col-md-12">
			<h3>版本历史</h3>
			<blockquote>Rexdb 1.0.0 （最新版本）</blockquote>
			<p>经过漫长的程序编写、重构和测试，第1个版本终于发布了。
			实际上在8年以前，框架就有了首个版本，从那时开始，框架便主要用于团队内部的项目研发。
			历经多年改版后和更名后，我终于意识到，项目的关注点永远不会在具体的框架技术上，难以维持框架的长期维护和升级。
			只有将开源软件才可能具备长期的生命力，于是我决定将它重构和开源。
			不管过去和未来怎样，至少现在已经发布了。
			</p>
		</div>
	</div>
	
	<div class="row" style="margin-top: 20px;">
		<div class="col-md-12">
			<h3>版本号规则</h3>
			
			<p>Rexdb的发布版都是通过了测试、预计可以稳定运行于生产环境的版本。但不可避免的，可能存在数量不多的BUG，研发团队会通过后期的迭代升级解决。Rexdb的版本号规则定义如下：</p>
			<blockquote>主版本号 . 子版本号 [. 修正版本号]</blockquote>
			<ul>
				<li><p>主版本号：具有相同名称但不同主版本号的程序集不可互换。</p></li>
				<li><p>子版本号：如果两个程序集的名称和主版本号相同，而次版本号不同，这指示显著增强，但照顾到了向后兼容性。</p></li>
				<li><p>修正版本号：名称、主版本号和次版本号都相同但修订号不同的程序集应是完全可互换的。这适用于修复以前发布的程序集中的安全漏洞。</p></li>
			</ul>
		</div>
	</div>
</div>

<? include_once('include/footer.php'); ?>
</body>
</html>
