<!DOCTYPE html>
<html>
<head>
<title>download</title>
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

<h1>下载 - 下载压缩包和编译源代码</h1>

<h2>下载地址</h2>

<p>Rexdb的压缩包中包含了源代码、编译好的jar包、可选的第三方jar包，以及用户文档。您可以到<a href="http://#">Rexdb的下载页面</a>下载包含上述内容的压缩包。如果您是Github用户，还可以访问<a href="https://github.com/rex-soft/rexdb">Rexdb的Github</a>，在这里检出当前最新的开发版本，以及各个历史版本。</p>

<p>直接下载请点击：<a href="http://#">最新版本的zip包</a>，<a href="http://#">最新版本的tar.gz包</a></p>

<h2>下载内容</h2>

<h2>编译源代码</h2>

<p>Rexdb压缩包中已经提供了编译后的jar包，如果您需要自行编译，需要准备如下环境：</p>

<ol>
<li>JDK1.5及以上版本</li>
<li><a href="https://ant.apache.org/">Apache Ant</a></li>
</ol>

<p>在编译前，请确保Rexdb压缩包被正确解压，并且目录结构未作更改。准备就绪后，在根目录运行如下命令编译：</p>

<pre><code>ant
</code></pre>

<p>如果您使用了IDE集成开发工具，也可以将压缩包解压后导入到工程中，由IDE工具编译。</p>

<h2>在Eclipse中编译源代码</h2>

</div>
</div>
<? include_once('../../include/footer.php'); ?>
</body>
</html>
