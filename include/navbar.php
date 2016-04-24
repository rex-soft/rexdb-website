<header>
	<div class="navbar navbar-default navbar-fixed-top" role="navigation" id="lead">
		<div class="container">
			<div class="navbar-header">
	    		  <button class="navbar-toggle" data-target="#nav" data-toggle="collapse" type="button" style="margin-right: 35px;">
	    		  	 <span class="sr-only"></span>
					 <span class="icon-bar"></span>
					 <span class="icon-bar"></span>
					 <span class="icon-bar"></span>
				 </button><a class="navbar-brand" href="http://db.rex-soft.org"><img src="<?=$basePath?>ui/images/logo.png" width="175" height="40" alt="Rexdb"/></a>
	  		 </div>
			<div id="nav" class="collapse navbar-collapse" aria-expanded="true">
				<ul class="nav navbar-nav navbar-right">
					<li menuid='download'><a href="download.php"><strong>下载</strong></a></li>
					<li menuid='document'><a href="document.php"><strong>文档</strong></a></li>
					<li menuid='performance'><a href="performance.php"><strong>性能</strong></a></li>
					<li menuid='feedback'><a href="feedback.php"><strong>反馈</strong></a></li>
				</ul>
			</div>
			<script type="text/javascript">
				var activeMenu = '<?=$activeMenu?>';
				if(activeMenu != '')
					$('#nav li[menuid=\''+activeMenu+'\']').addClass('active');
			</script>
		</div>
	</div>
</header>
