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
		      	<span class="media-object iconfont icon-java iconmain iconmain-prim"></span>
		      </div>
		      <div class="media-body">
		        <h4 class="media-heading">编译好的程序</h4>
		        <ul class="list-group">
				  <li class="list-group-item">
				  	<i class="iconfont icon-zip"></i>
				   	<a href="#"><b>rexdb-1.0.0.zip</b></a>
				   	(<a href="#">tar.gz</a>)
				   	
				    <span class="remark">编译好的程序包，以及文档、第三方包和简单的程序示例</span>
				  </li>
				  
				  <li class="list-group-item">
				  	<i class="iconfont icon-zip"></i>
				   	<a href="#"><b>rexdb-tester-1.0.0.zip</b></a>
					(<a href="#">tar.gz</a>)
					
				    <span class="remark">性能测试程序，用于测试Rexdb和其它开源框架的性能</span>
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
				   	
				    <span class="remark">Rexdb的源代码，以及编译时依赖的包</span>
				  </li>
				  
				  <li class="list-group-item">
				  	<i class="iconfont icon-zip"></i>
				   	<a href="#">rexdb-tester-source-1.0.0.zip</a>
				    (<a href="#">tar.gz</a>)
				    
				    <span class="remark">性能测试程序的源代码，以及编译时依赖的包</span>
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
				   	<a href="download/1.0/doc/1.intro.pdf">简介</a>
				    <span class="remark">Rexdb框架的功能和特点</span>
				  </li>
				  <li class="list-group-item">
				  	<i class="iconfont icon-cspdf"></i>
				   	<a href="download/1.0/doc/2.download.pdf">下载</a>
				    <span class="remark">如何获取Rexdb</span>
				  </li>
				  <li class="list-group-item">
				  	<i class="iconfont icon-cspdf"></i>
				   	<a href="download/1.0/doc/3.quick-start-beginner.pdf">快速入门（初学者）</a>
				    <span class="remark">面向初学者的快速入门教程</span>
				  </li>
				  <li class="list-group-item">
				  	<i class="iconfont icon-cspdf"></i>
				   	<a href="download/1.0/doc/4.quick-start.pdf">快速入门（通用）</a>
				    <span class="remark">面向大部分开发人员的快速入门教程</span>
				  </li>
				  <li class="list-group-item">
				  	<i class="iconfont icon-cspdf"></i>
				   	<a href="download/1.0/doc/5.user-manual.pdf">用户手册</a>
				    <span class="remark">完整的开发人员参考文档，包含详细的示例、配置和接口说明</span>
				  </li>
				  
				  <li class="list-group-item">
				  	<i class="iconfont icon-cspdf"></i>
				   	<a href="download/1.0/doc/6.performance-user-manual.pdf">性能测试程序用户手册</a>
				    <span class="remark">性能测试程序的使用文档</span>
				  </li>
				</ul>
		      </div>
		    </div>	
		
		</div>
	</div>
	
	<div id="download-github" class="row">
		<div class="col-md-12">
			<h3>Git</h3>
			<p>Rexdb的源代码托管在Github和Oschina码云中。如果您不了解如何使用，请参考<a href="https://help.github.com/index.html" target="_blank">Github Help（英文）</a>或者<a href="http://git.mydoc.io/" target="_blank">Oschina码云帮助文档</a>。</p>
			
			<blockquote>Github</blockquote>
			<pre>clone https://github.com/rex-soft/rexdb.git
clone https://github.com/rex-soft/rexdb-tester.git</pre>

			<blockquote>Oschina码云</blockquote>
			<pre>clone https://git.oschina.net/rexsoft/rexdb.git
clone https://git.oschina.net/rexsoft/rexdb-tester.git</pre>
		</div>
	</div>
	
	<div id="download-history" class="row">
		<div class="col-md-12">
			<h3>版本</h3>
			<p>当前最新的发布版本是Rexdb-1.0.2。</p>
			  <ul class="timeline">
			    <li><div class="tldate">版本升级计划</div></li>
			    
			    <li>
			      <div class="tl-circ"></div>
			      <div class="timeline-panel">
			        <div class="tl-heading">
			          <h4 class="text-muted">Rexdb-1.2.0</h4>
			          <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 2017年3月（预计）</small></p>
			        </div>
			        <div class="tl-body">
			          <p>
			          	<ol>
			          		<li>增加对其它开源框架的支持插件，例如对Spring事物模板的支持</li>
			          		<li>支持配置文件内容加密</li>
			          	</ol>
			          </p>
			        </div>
			      </div>
			    </li>
			    
			    <li class="timeline-inverted">
			      <div class="tl-circ"></div>
			      <div class="timeline-panel">
			        <div class="tl-heading">
			          <h4 class="text-muted">Rexdb-1.1.0</h4>
			          <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 2016年12月（预计）</small></p>
			        </div>
			        <div class="tl-body">
			          <p>
			          	<ol>
			          		<li>强化方言和SQL分析模块，支持关键字和函数标记</li>
			          		<li>支持POJO中的注解，降低插入/更新操作的编码量</li>
			          		<li>升级批处理接口，加强List类型参数的兼容性</li>
			          	</ol>
			          </p>
			        </div>
			      </div>
			    </li>
			    
			    <li><div class="tldate text-primary">已发布版本</div></li>
			    
			    <li>
			      <div class="tl-circ"></div>
			      <div class="timeline-panel">
			        <div class="tl-heading">
			          <h4>Rexdb-1.0.2</h4>
			          <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 2016-08-24 </small></p>
			        </div>
			        <div class="tl-body">
			          <p>这是第一个公开发布版本，已经通过测试，并正在稳定运行于多个生产系统。</p>
			          <p>
			          	<ol>
			          		<li>简化JTA事物启动接口为beginJta()</li>
			          		<li>增加支持java.util.List参数类型的批处理接口</li>
			          	</ol>
			          </p>
			        </div>
			      </div>
			    </li>
			    <li class="timeline-inverted">
			      <div class="tl-circ"></div>
			      <div class="timeline-panel">
			        <div class="tl-heading">
			          <h4>Rexdb-1.0.1（内部版本）</h4>
			          <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 2016-04-05</small></p>
			        </div>
			        <div class="tl-body">
			          <p>这个仍然是一个内部版本，正在应用于若干个软件项目。</p>
			          <p>
			          	<ol>
			          		<li>补充和修正源代码中的注释</li>
			          		<li>修复了若干个不准确或者遗漏的异常信息</li>
			          		<li>修复了org.rex.db.Ps对象可能抛出空指针异常的问题</li>
			          		<li>修复了PostgreSQL等方言模块中的问题</li>
			          	</ol>
			          </p>
			        </div>
			      </div>
			    </li>
			    <li class="timeline-inverted">
			      <div class="tl-circ"></div>
			      <div class="timeline-panel">
			        <div class="tl-heading">
			          <h4>Rexdb-1.0.0（内部版本）</h4>
			          <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 2016-03-01 </small></p>
			        </div>
			        <div class="tl-body">
			          <p>首个正式版本已经完成，经全面测试后，预计可应用于生产环境。但稳妥起见，这个版本仍然是内部版本，将在软件项目中稳定运行一段时间后发布。</p>
			        </div>
			      </div>
			    </li>
			    
			    <li class="timeline-inverted">
			      <div class="tl-circ"></div>
			      <div class="timeline-panel">
			        <div class="tl-heading">
			          <h4>Rexdb-beta（内部版本）</h4>
			          <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 2016-01-12 </small></p>
			        </div>
			        <div class="tl-body">
			          <p>框架的编写已经完成，这个版本仅用于测试，不能用于生产环境，在测试完成后会对某些模块进行重构。</p>
			        </div>
			      </div>
			    </li>
			    <li>
			      <div class="tl-circ"></div>
			      <div class="timeline-panel">
			        <div class="tl-heading">
			          <h4>开始！</h4>
			          <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 2015-08-01</small></p>
			        </div>
			        <div class="tl-body">
			          <p>9年前，因某些无法忍受的问题，我在项目中放弃了当时最流行的开源ORM框架，并自行编写了框架，很快取得了一致好评。
			          	自那以后，该框架开始应用于团队内部和合作伙伴的软件研发。
			          </p>
			          <p>
						但历经多年改版后，我终于意识到，研发团队很难将关注点聚焦在具体的框架技术上，难以维持其长期维护和升级。
						只有将开源软件才能具备长期的生命力，走自给自足的封闭路线只会慢慢使其消亡。
					  </p>
					  <p>
						于是我决定将它重构和开源，只是希望还不算晚。</p>
			        </div>
			      </div>
			    </li>
			  </ul>
		</div>
	</div>
	
	<div id="download-version" class="row">
		<div class="col-md-12">
			<h3>版本号规则</h3>
			
			<p>Rexdb的发布版均进行了测试，预计可以稳定运行于生产环境。但不可避免的可能存在数量不多的BUG，研发团队会通过后期的迭代升级解决。Rexdb的版本号规则定义如下：</p>
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
