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
<title>文档 - Rexdb ORM</title>
<?php
$basePath = '';
include_once('include/import.php'); 
?>
<link rel="stylesheet" href="<?php echo $basePath;?>ui/css/document-1.0.2.css" type="text/css"></link>
<script type="text/javascript" src="<?php $basePath;?>ui/js/docs.min-1.0.2.js"></script>
<script>
var basePath = '<?php $dirPath;?>';
$(document).ready(function(){
	//调整图片资源URI
	$('div[role=\'main\'] img').each(function(){
		var src = $(this).attr('data-src');
		if(src.indexOf('http') != 0){
			$(this).attr('src', basePath + '/' + src);
			$(this).parent().after($(this));
		}
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
<?php
$activeMenu = 'document';
include_once('include/navbar.php'); 
?>
<section id="header" class="top-div">
	<div class="container doc-content">	
		<div class="row" style="margin-top: 20px; margin-bottom: 30px">
			<div class="col-md-12">
				<h3>文档目录</h3>
				<?php include_once($contentFile); ?>
			</div>
		</div>
	</div>
</section>
<div class="container">
<div class="row">

<div class="col-md-9" role="main">
<?php
	include_once($pathFile);
?>
</div>

      <div class="col-md-3" role="complementary">
          <nav class="bs-docs-sidebar hidden-print hidden-xs hidden-sm">

<?php
	include_once($navFile);
?>

            <a class="back-to-top" href="#user-content-top">返回顶部</a>
            
          </nav>
        </div>



</div>
</div>
<?php include_once('include/footer.php'); ?>
</body>
</html>
