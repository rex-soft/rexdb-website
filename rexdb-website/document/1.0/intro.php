<!DOCTYPE html>
<html>
<head>
<title>intro</title>
<?
$basePath = '../../';
include_once('../../include/import.php'); 
?>
<link rel="stylesheet" href="../../style/document.css" type="text/css"></link>
</head>
<body>
<? include_once('../../include/navbar.php'); ?>
<? include_once('_contents.php'); ?>
<div class="container">
<div class="row">

	<h1>简介 - Rexdb框架的功能和特点</h1>
	
	<h2>概述</h2>
	
	<p>Rexdb是一款使用Java语言编写的，开放源代码的持久层框架。它具有管理数据源、执行SQL、调用函数和存储过程、处理事务等功能。使用Rexdb时，不需要像JDBC一样编写繁琐的代码，也不需要编写数据表映射文件，只要将SQL和Java对象等参数传递至框架接口，即可获取需要的结果。</p>
	
	<p>Rexdb具有接口灵活、使用简单、性能良好等特点。更加适合于功能复杂、需要快速迭代或是对性能要求严苛的软件项目。由于框架使用难度较低，不需要进行长期的专题培训，所以也适合于临时组建、或是外包成员较多的研发团队。</p>
	
	<h2>功能</h2>
	
	<ul>
	<li>数据库查询、更新、批量处理、函数和存储过程调用、事物和JTA事物等；</li>
	<li>ORM映射，可以使用数组、Map、Java对象作为预编译参数，也可以自动将结果集转换为Map、Java对象；</li>
	<li>数据源管理，拥有内置的连接池和数据源，支持第三方数据源和JNDI；</li>
	<li>数据库方言，自动封装分页查询和常用函数，支持Oracle、DB2、SQL Server、Mysql、达梦等数据库；</li>
	<li>支持对框架初始化、SQL执行、事物等事件的监听；</li>
	<li>统一的异常管理、异常信息的国际化支持等；</li>
	</ul>
	
	<h2>特点和优势</h2>
	
	<ul>
	<li>编码量少，不需要编写映射配置，且只需要少量代码就可以完成与数据库的交互；</li>
	<li>使用简单，学习难度极低，开发人员不需要学习繁琐的配置规则，详情请参见<a href="quick-start.html">Rexdb快速上手指南</a>；</li>
	<li>性能良好，框架具有极低的性能损耗，性能测试结果请查看<a href="http://#">Rexdb性能测试报告</a>；</li>
	<li>兼容性好，没有必须依赖的第三方包，可以与其它框架组合使用。</li>
	</ul>
	
	<h2>官方网站</h2>
	
	<p>Rexdb的网站地址是：<a href="http://db.rex-soft.org">http://db.rex-soft.org</a>。</p>
	
	<h2>帮助和支持</h2>
	
	<p>Rexdb是免费的开源软件，除源代码、文档和示例外，不提供技术支持。但开发团队致力于改进框架的使用体验，欢迎使用者<a href="http://#">提出需求和BUG反馈</a>。</p>
	
	<h2>使用协议</h2>
	
	<p>Rexdb基于Apache 2.0协议，可以免费用于个人或商业用途。</p>
	
	<p>协议详情请见：<a href="http://www.apache.org/licenses/LICENSE-2.0.html">Apache Lisence, Version 2.0</a></p>

</div>
</div>
<? include_once('../../include/footer.php'); ?>
</body>
</html>
