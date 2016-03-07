<!DOCTYPE html>
<html>
<head>
<title>下载 - Rexdb</title>
<?
include_once('include/import.php'); 
?>
<style>
p{
	font-size: 16px;
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

<div class="container top-div">
	<div class="row" style="margin-top: 20px; margin-bottom: 20px">
		<div class="col-md-12">
			<h3>最新版本</h3>
			<p>以下是Rexdb发布的第一个稳定版。已经通过了测试，预计可以稳定运行于生产环境。</p>
			<p>编译好的包：</p>
			<ul>
				<li>
					<p>
						<a href="#"><b>rexdb-1.0.0.zip</b></a>
						(<a href="#">pgp</a>, <a href="#">md5</a>, <a href="#">sha1</a>)
					</p>
				</li>
				<li>
					<p>
						<a href="#"><b>rexdb-1.0.0.tar.gz</b></a>
						(<a href="#">pgp</a>, <a href="#">md5</a>, <a href="#">sha1</a>)
					</p>
				</li>
			</ul>
			
			<p>源代码：</p>
			<ul>
				<li>
					<p>
						<a href="#"><b>rexdb-source-1.0.0.zip</b></a>
						(<a href="#">pgp</a>, <a href="#">md5</a>, <a href="#">sha1</a>)
					</p>
				</li>
				<li>
					<p>
						<a href="#"><b>rexdb-source-1.0.0.tar.gz</b></a>
						(<a href="#">pgp</a>, <a href="#">md5</a>, <a href="#">sha1</a>)
					</p>
				</li>
			</ul>
			<p>运行环境要求：</p>
			<ul>
				<li>
					<p>
						JDK-1.5 及以上版本
					</p>
				</li>
				<li>
					<p>
						支持JDBC
					</p>
				</li>
			</ul>
		</div>
	</div>
	
	<div class="row" style="margin-top: 20px; margin-bottom: 20px">
		<div class="col-md-12">
			<h3>Github库</h3>
			<p>Rexdb的代码托管在Github库中，您可以下载到几乎所有版本的源文件和二进制发行文件。</p>
			<pre>clone https://github.com/rex-soft/rexdb.git</pre>
		</div>
	</div>
	
	<div class="row" style="margin-top: 20px;">
		<div class="col-md-12">
			<h3>版本历史</h3>
			<blockquote>Rexdb 1.0.0 （最新版本）</blockquote>
			<p>经过漫长的程序编写、重构和测试，第1个版本终于发布了。
			实际上至少在8年以前，框架就有了首个版本，从那时开始，框架便主要用于团队内部的项目研发，也不叫这个名字。
			历经多年改版后和更名后，我终于意识到，只有开源软件才有可能具备长期的生命力，于是决定将它重构和开源。
			不管过去和未来怎样，至少现在已经发布了。
			</p>
		</div>
	</div>
</div>

<? include_once('include/footer.php'); ?>
</body>
</html>
