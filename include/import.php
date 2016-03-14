<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?=$basePath?>style/bootstrap-3.3.5/css/bootstrap.css" type="text/css"></link>
<link rel="stylesheet" href="<?=$basePath?>style/bootstrap-3.3.5/css/bootstrap-responsive.css" type="text/css"></link>
<link rel="stylesheet" href="<?=$basePath?>style/main.css" type="text/css"></link>
<script src="<?=$basePath?>style/jquery.min.js"></script>
<script type="text/javascript" src="<?=$basePath?>style/bootstrap-3.3.5/js/bootstrap.js"></script>
<script>
$(document).scroll(function(){
	if($(document).scrollTop() == 0){
		$('#lead').removeClass('navbar-shadow');
	}else
		$('#lead').addClass('navbar-shadow');
		
})
</script>
