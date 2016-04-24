<!DOCTYPE html>
<html>
<head>
<title>下载 - Rexdb ORM</title>
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

<!-- 
<section id="header" class="top-div">
	<div class="container">	
		<div class="row" style="margin-top: 0; margin-bottom: 50px">
			<div class="col-md-12">
				<h3>下载</h3>
				<br/>
				<p>
				Rexdb是开源软件，所有版本的程序和源代码都提供了下载。
				</p>
			</div>
		</div>
	</div>
</section>
  -->
  
<div class="container top-div">
	<div id="download-latest" class="row">
		<div class="col-md-12">
		
			<div class="media dl">
		      <div class="media-left">
		      	<span class="media-object iconfont icon-java iconmain"></span>
		      </div>
		      <div class="media-body">
		        <h4 class="media-heading">编译好的程序</h4>
		        <ul class="list-group">
				  <li class="list-group-item">
				  	<i class="iconfont icon-zip"></i>
				   	<a href="#"><b>rexdb-1.0.0.zip</b></a>
				   	(<a href="#">tar.gz</a>)
				   	
				    <span class="badge">校验码</span>
				    <span class="remark">编译好的程序包</span>
				  </li>
				  
				  <li class="list-group-item">
				  	<i class="iconfont icon-zip"></i>
				   	<a href="#"><b>rexdb-tester-1.0.0.zip</b></a>
					(<a href="#">tar.gz</a>)
					
				   	<span class="badge">校验码</span>
				    <span class="remark">性能测试程序</span>
				  </li>
				</ul>
		      </div>
		    </div>
		
			<div class="media dl">
		      <div class="media-left">
		          <span class="media-object iconfont icon-code iconmain iconmain-prim"></span>
		      </div>
		      <div class="media-body">
		        <h4 class="media-heading">源代码</h4>
		        <ul class="list-group">
				  <li class="list-group-item">
				  	<i class="iconfont icon-zip"></i>
				   	<a href="#">rexdb-source-1.0.0.zip</a>
				   	(<a href="#">tar.gz</a>)
				   	
				    <span class="badge">校验码</span>
				    <span class="remark">源文件和依赖的包</span>
				  </li>
				  
				  <li class="list-group-item">
				  	<i class="iconfont icon-zip"></i>
				   	<a href="#">rexdb-tester-source-1.0.0.zip</a>
				    (<a href="#">tar.gz</a>)
				    
				    <span class="badge">校验码</span>
				    <span class="remark">性能测试程序源代码和依赖的包</span>
				  </li>
				</ul>
		      </div>
		    </div>	
		
			<div class="media dl">
		      <div class="media-left">
		          <span class="media-object  iconfont icon-document iconmain iconmain-prim"></span>
		      </div>
		      <div class="media-body">
		        <h4 class="media-heading">文档</h4>
		        <ul class="list-group">
				  <li class="list-group-item">
				  	<i class="iconfont icon-cspdf"></i>
				   	<a href="#">简介</a>
				   	
				    <span class="remark">框架的功能和特点</span>
				  </li>
				  
				  <li class="list-group-item">
				  	<i class="iconfont icon-cspdf"></i>
				   	<a href="#">下载和使用</a>
				    
				    <span class="remark">下载压缩包和编译源代码</span>
				  </li>
				  
				  <li class="list-group-item">
				  	<i class="iconfont icon-cspdf"></i>
				   	<a href="#">快速入门</a>
				    
				    <span class="remark">面向初学者的快速入门教程</span>
				  </li>
				  
				  <li class="list-group-item">
				  	<i class="iconfont icon-cspdf"></i>
				   	<a href="#">用户手册</a>
				    
				    <span class="remark">开发人员参考文档</span>
				  </li>
				  
				  <li class="list-group-item">
				  	<i class="iconfont icon-cspdf"></i>
				   	<a href="#">性能测试程序用户手册</a>
				    
				    <span class="remark">性能测试程序的参考文档</span>
				  </li>
				  
				  <li class="list-group-item">
				  	<i class="iconfont icon-cspdf"></i>
				   	<a href="#">API</a>
				    
				    <span class="remark">Java API文档</span>
				  </li>
				</ul>
		      </div>
		    </div>	
		
		</div>
	</div>
	
	<div id="download-github" class="row">
		<div class="col-md-12">
			<h3>Github</h3>
			<p>Rexdb的源代码托管在Github库中。如果您不了解Github，请参考<a href="https://help.github.com/index.html" target="_blank">Help</a>（英文）。</p>
			<pre>clone https://github.com/rex-soft/rexdb.git
clone https://github.com/rex-soft/rexdb-tester.git</pre>
		</div>
	</div>
	
	<div id="download-history" class="row">
		<div class="col-md-12">
			<h3>历史版本</h3>
			<blockquote>Rexdb 1.0.0 （最新版本）</blockquote>
			<p>经过漫长的程序编写、重构和测试，第1个版本终于发布了。
			实际上在8年以前，框架就有了首个版本，从那时开始，框架便主要用于团队内部的项目研发。
			历经多年改版后和更名后，我终于意识到，项目的关注点永远不会在具体的框架技术上，难以维持框架的长期维护和升级。
			只有将开源软件才可能具备长期的生命力，于是我决定将它重构和开源。
			不管过去和未来怎样，至少现在已经发布了。
			</p>
		</div>
	</div>
	
	<div id="download-version" class="row">
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
