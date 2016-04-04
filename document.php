<?php 
$version = !empty($_GET["version"] )? $_GET["version"] : '1.0';
$documentId = !empty($_GET["doc"]) ? $_GET["doc"] : 'intro';

$dirPath = 'document/' . $version;
$contentFile = $dirPath . '/_contents.php';
$pathFile = $dirPath . '/' . $documentId . '.php';
$navFile = $dirPath . '/content/' . $documentId . '.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>文档 - Rexdb</title>
<?
$basePath = '';
include_once('include/import.php'); 
?>
<link rel="stylesheet" href="style/document.css" type="text/css"></link>
<link rel="stylesheet" href="style/docs.min.css" type="text/css"></link>
<script type="text/javascript" src="<?=$basePath?>style/docs.min.js"></script>
<script>
var basePath = '<?=$dirPath?>';
$(document).ready(function(){
	//页内锚点
	$('.bs-docs-sidebar a').on('click', function(){
		var href = $(this).attr('href');
		if(href.indexOf('#') == -1) return;
		
		var targetId = href.substr(href.lastIndexOf('#'), href.length);
		var target = $(targetId);
	        if(target.length==1){
	             var top = target.offset().top-99;
	             if(top > 0){
	                 $('html,body').animate({scrollTop:top}, 200);
	             }
	         } 
	         
		return false;
	});
	//调整图片资源URI
	$('div[role=\'main\'] img').each(function(){
		var src = $(this).attr('src');
		if(src.indexOf('http') != 0)
			$(this).attr('src', basePath + '/' + src);
	});
	//文档总目录
	var href = window.location.href;
	var uri = href.substr(href.indexOf('document.php'));
	var a = $('#learning').find('a[href=\''+uri+'\']');
	if(a.length == 0) a = $('#learning a:first');
	a.before('<blockquote>'+a.html()+'</blockquote>').remove();
});
</script>
</head>
<body>
<? 
$activeMenu = 'document';
include_once('include/navbar.php'); 
?>
<section id="header" class="top-div">
	<div class="container doc-content">	
		<div class="row" style="margin-top: 0px; margin-bottom: 20px">
			<div class="col-md-12">
				<h3>文档目录</h3>
				<? include_once($contentFile); ?>
			</div>
		</div>
	</div>
</section>
<div class="container">
<div class="row">

<div class="col-md-9" role="main">
<?
	include_once($pathFile);
?>
</div>

      <div class="col-md-3" role="complementary">
          <nav class="bs-docs-sidebar hidden-print hidden-xs hidden-sm">

<?
	include_once($navFile);
?>

            <a class="back-to-top" href="#top">返回顶部</a>
            
          </nav>
        </div>



</div>
</div>
<? include_once('include/footer.php'); ?>
</body>
</html>
