<!DOCTYPE html>
<html>
<head>
<title>download</title>
<?
include_once('include/import.php'); 
?>
<link rel="stylesheet" href="style/document.css" type="text/css"></link>
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

echo '-------------------------'.$pathFile
?>
<section id="header" class="top-div">
	<div class="container">	
		<? include_once($contentFile); ?>
	</div>
</section>
<div class="container">
<div class="row">

<?
	include_once($pathFile);
?>

</div>
</div>
<? include_once('include/footer.php'); ?>
</body>
</html>
