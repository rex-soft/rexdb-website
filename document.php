<!DOCTYPE html>
<html>
<head>
<title>download</title>
<?
include_once('include/import.php'); 
?>
<link rel="stylesheet" href="style/document.css" type="text/css"></link>
<link rel="stylesheet" href="style/docs.min.css" type="text/css"></link>
<script type="text/javascript" src="<?=$basePath?>style/docs.min.js"></script>
</head>
<body>
<? 
$activeMenu = 'document';
include_once('include/navbar.php'); 
?>
<?php 
$version = $_GET["version"] ? $_GET["version"] : '1.0';
$documentId = $_GET["doc"] ? $_GET["doc"] : 'intro';

$dirPath = 'document/' . $version;
$contentFile = $dirPath . '/_contents.php';
$pathFile = $dirPath . '/' . $documentId . '.php';
$navFile = $dirPath . '/content/' . $documentId . '.php';

echo '-------------------------'.$pathFile
?>
<section id="header" class="top-div">
	<div class="container">	
		<? include_once($contentFile); ?>
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
            
            <a class="back-to-top" href="#top">
              返回顶部
            </a>
            
          </nav>
        </div>



</div>
</div>
<? include_once('include/footer.php'); ?>
</body>
</html>
